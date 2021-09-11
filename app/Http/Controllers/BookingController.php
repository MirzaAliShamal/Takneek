<?php

namespace App\Http\Controllers;

use App\Models\BookingAppointment;
use Illuminate\Http\Request;
use App\Models\BookingExtra;
use App\Models\Coworking;
use App\Models\Booking;
use App\Models\Extra;
use App\Models\User;
use Str;
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
            // Define the page and number of items per page
            $page = 1;
            $per_page = 10;

            // Define the default order
            $order_field = 'date';
            $order_sort = 'asc';

            // Get the request parameters
            $params = $req->all();
            $query = Booking::select('date', DB::raw('count(*) as total_booking'), DB::raw('sum(total_price) as total_price'))->groupBy('date');

            // Set the current page
            if(isset($params['pagination']['page'])) {
                $page = $params['pagination']['page'];
            }

            // Set the number of items
            if(isset($params['pagination']['perpage'])) {
                $per_page = $params['pagination']['perpage'];
            }

            // Set the search filter
            if(isset($params['query']['generalSearch'])) {
                $query->where('name', 'LIKE', "%" . $params['query']['generalSearch'] . "%")
                ->orWhere('file', 'LIKE', "%" . $params['query']['generalSearch'] . "%");
            }

            // Set the status filter
            if(isset($params['query']['Status'])) {
                $query->where('status', $params['query']['Status']);
            }

            // Set the sort order and field
            if(isset($params['sort']['field'])) {
                $order_field = $params['sort']['field'];
                $order_sort = $params['sort']['sort'];
            }

            // Get how many items there should be
            $total = $query->limit($per_page)->count();

            // Get the items defined by the parameters
            $results = $query->skip(($page - 1) * $per_page)->take($per_page)->orderBy($order_field, $order_sort)->get();


            $res = [];

            foreach ($results as $key => $value) {
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
                    'TotalAmount' => "$".number_format($value->total_price),
                );
            }

            $data = [
                'meta' => [
                    "page" => $page,
                    "pages" => ceil($total / $per_page),
                    "perpage" => $per_page,
                    "total" => $total,
                    "sort" => $order_sort,
                    "field" => $order_field
                ],

                'data' => $res
            ];
            return response()->json($data, 200);
        }
    }

    function getByDate(Request $req)
    {
        if ($req->ajax()) {
            $page = 1;
            $per_page = 10;

            // Define the default order
            $order_field = 'time';
            $order_sort = 'desc';

            // Get the request parameters
            $params = $req->all();
            $query = Booking::where('date', $params['query']['Date']);

            // Set the current page
            if(isset($params['pagination']['page'])) {
                $page = $params['pagination']['page'];
            }

            // Set the number of items
            if(isset($params['pagination']['perpage'])) {
                $per_page = $params['pagination']['perpage'];
            }

            // Set the search filter
            if(isset($params['query']['generalSearch'])) {
                $query->where('name', 'LIKE', "%" . $params['query']['generalSearch'] . "%")
                ->orWhere('file', 'LIKE', "%" . $params['query']['generalSearch'] . "%");
            }

            // Set the status filter
            if(isset($params['query']['Status'])) {
                $query->where('status', $params['query']['Status']);
            }

            // Get how many items there should be
            $total = $query->limit($per_page)->count();

            // Get the items defined by the parameters
            $results = $query->skip(($page - 1) * $per_page)->take($per_page)->orderBy($order_field, $order_sort)->get();


            $res = [];
            foreach ($results as $key => $value) {
                $res[] = array(
                    'BookingID' => $value->id,
                    'Time' => $value->time,
                    'Customer' => Str::limit(implode(", " , $value->users->pluck('name')->toArray()), 10, '...'),
                    'Service' => $value->bookingable->name,
                    'Addons' => $value->booking_extras()->count(),
                    'Seats' => '3',
                    'Amount' => "$".number_format($value->total_price),
                    'PaymentMethod' => 'Paytm',
                );
            }

            $data = [
                'meta' => [
                    "page" => $page,
                    "pages" => ceil($total / $per_page),
                    "perpage" => $per_page,
                    "total" => $total,
                    "sort" => $order_sort,
                    "field" => $order_field
                ],

                'data' => $res
            ];
            return response()->json($data, 200);
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
        // dd($req);
        $booking = new Booking();
        $booking->bookingable_type = "App\Models\Coworking";
        $booking->bookingable_id = $req->bookingable;
        $booking->bring_anyone = $req->bring_anyone == 'on' ? 1 : 0;
        $booking->date = $req->date;
        $booking->time = $req->time;
        $booking->recurring_booking = $req->recurring_booking == 'on' ? 1 : 0;
        $booking->recurring_type = $req->recurring_type;
        $booking->recurring_interval = $req->recurring_interval;
        if (!is_null($req->monthly_dropdown)) {
            $booking->monthly_dropdown = $req->monthly_dropdown;
        }
        if ($req->recurring_type == "weekly") {
            $booking->week_days = json_encode($req->week_days);
        }
        $booking->recurring_until = $req->recurring_until;
        $booking->times = $req->times;
        $booking->service_price = $req->service_price;
        $booking->extra_price = $req->extra_price;
        $booking->total_price = $req->total_price;
        $booking->save();

        if ($booking) {
            $booking->booking_appointments()->delete();
            for ($i=0; $i < $req->times ; $i++) {
                $appointment = new BookingAppointment();
                $appointment->booking_id = $booking->id;
                $appointment->date = $req->recurring_appointments_date[$i];
                $appointment->time = $req->recurring_appointments_time[$i];
                $appointment->save();
            }

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
                $extra_person->profile_picture = "default.png";
                $extra_person->save();

                $extra_person->assignRole('Visitor');

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
