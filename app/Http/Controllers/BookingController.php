<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingExtra;
use App\Models\Coworking;
use App\Models\Booking;
use App\Models\Extra;
use App\Models\User;
use DB;

class BookingController extends Controller
{
    public function list(Request $req)
    {
        if ($req->ajax()) {
            $list = Booking::select('date', DB::raw('count(*) as total_booking'), DB::raw('sum(total_price) as total_price'))->groupBy('date')->get();

            return response()->json($list, 200);
        } else {
            return view('back.booking.list',get_defined_vars());
        }
    }

    public function get(Request $req)
    {
        if ($req->ajax()) {
            $list = Booking::select('date', DB::raw('count(*) as total_booking'), DB::raw('sum(total_price) as total_price'))->groupBy('date')->get();


            $res = [];

            foreach ($list as $key => $value) {
                $serv = [];
                $service_q = Booking::where('date', $value->date)->get();
                foreach ($service_q as $k => $v) {
                    $serv[] = $v->bookingable->name;
                }

                $res[] = array(
                    'Index' => $key,
                    'Date' => $value->date,
                    'Service' => array_unique($serv),
                    'TotalBookings' => $value->total_booking,
                    'TotalAmount' => "$".$value->total_price,
                );
            }
            return response()->json($res, 200);
        }
    }

    function getByDate(Request $req)
    {
        if ($req->ajax()) {
            $list = Booking::where('date', $req['query']['Date'])->orderBy('time','desc')->get();

            $res = [];
            foreach ($list as $key => $value) {
                $res['data'][] = array(
                    'BookingID' => $value->id,
                    'Time' => $value->time,
                    'Customer' => "Ali",
                    'Service' => $value->bookingable->name,
                    'Addons' => '2',
                    'Seats' => '3',
                    'Amount' => $value->total_price,
                    'PaymentMethod' => 'Paytm',
                );
            }
            return response()->json($res, 200);
        }
    }

    public function add()
    {
        $users = User::orderBy('name', 'ASC')->get();
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.booking.add', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req, $id = null)
    {

        $booking = new Booking();
        $booking->bookingable_type = "App\Models\Coworking";
        $booking->bookingable_id = $req->bookingable;
        $booking->bring_anyone = $req->bring_anyone == 'on' ? 1 : 0;
        $booking->date = $req->date;
        $booking->time = $req->time;
        $booking->recurring_booking = $req->recurring_booking == 'on' ? 1 : 0;
        $booking->recurring_type = $req->recurring_type;
        $booking->recurring_interval = $req->recurring_interval;
        $booking->recurring_until = $req->recurring_until;
        $booking->service_price = $req->service_price;
        $booking->extra_price = $req->extra_price;
        $booking->total_price = $req->total_price;
        $booking->save();

        if ($booking) {
            $booking->booking_extras()->delete();
            for ($i=0; $i < count($req->extra_id) ; $i++) {
                $extra = new BookingExtra();
                $extra->booking_id = $booking->id;
                $extra->extra_id = $req->extra_id[$i];
                $extra->extra_qty = $req->extra_qty[$i];
                $extra->extra_price = $req->e_price[$i];
                $extra->save();
            }


            $ids[] = $req->user_id;
            for ($i=0; $i < $req->additional_persons ; $i++) {
                $extra_person = new User();
                $extra_person->name = $req->additional_person_name[$i];
                $extra_person->email = $req->additional_person_email[$i];
                $extra_person->password = bcrypt('12345678');
                $extra_person->save();

                $ids[] = $extra_person->id;
            }

            $cur_ids = array();
            foreach($booking->users as $e){
                $cur_ids[] = $e->id;
            }
            $booking->users()->detach($cur_ids);

            $users = User::find($ids);
            $booking->users()->attach($users);
        }

        return redirect()->back()->with('success', 'Booking Done');
    }
}
