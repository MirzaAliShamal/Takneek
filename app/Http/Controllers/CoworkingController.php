<?php

namespace App\Http\Controllers;

use App\Models\Coworking;
use App\Models\CoworkingExtra;
use App\Models\CoworkingImage;
use App\Models\Location;
use Illuminate\Http\Request;

class CoworkingController extends Controller
{
    public function list()
    {
        $list = Coworking::orderBY('id','desc')->get();

        return view('back.coworking.list',get_defined_vars());
    }

    public function add()
    {
        $locations = Location::all();

        return response()->json(view('back.coworking.add', get_defined_vars())->render(), 200);
    }

    public function edit($id = null)
    {
        $locations = Location::all();
        $coworking = Coworking::with('coworking_images', 'coworking_extras')->find($id);

        return response()->json(view('back.coworking.edit', get_defined_vars())->render(), 200);
    }


    public function page_coworking()
    {
        $list=Coworking::orderBY('id','desc')->get();
        $locations=Location::all();
        return view('back.coworking.page-coworkings',get_defined_vars());
    }

    public function save(Request $req, $id = null)
    {
        $req->validate([
            'name'=>'required',
        ]);

        if (is_null($id)) {
            $coworking = new Coworking();
        } else {
            $coworking = Coworking::find($id);
        }

        $coworking->name = $req->name;
        $coworking->duration = $req->duration;
        $coworking->location_id = $req->location;
        $coworking->price = $req->price;
        $coworking->buffer_before_time = $req->buffer_before_time;
        $coworking->buffer_after_time = $req->buffer_after_time;
        $coworking->max_seats = $req->max_seats;
        $coworking->bringing_anyone_with_you = $req->bringing_anyone_with_you ?? 0;
        $coworking->price_multiple_by_number = $req->price_multiple_by_number ?? 0;
        $coworking->recurring_appointment = $req->recurring_appointment;
        $coworking->unavailable_recurring_dates = $req->unavailable_recurring_dates;
        $coworking->recurring_appointment_payments = $req->recurring_appointment_payments;
        $coworking->description = $req->description;
        $coworking->extra_mandatory = $req->extra_mandatory ?? 0;
        $coworking->min_extra = $req->min_extra ?? 0;
        $coworking->save();


        if(count(array_filter($req->extra_name)) > 0) {
            $coworking->coworking_extras()->delete();
            $extras = array_filter($req->extra_name);
            for ($i=1; $i <= count(array_filter($req->extra_name)); $i++) {
                $extras = CoworkingExtra::create([
                    'coworking_id' => $coworking->id,
                    'extra_name' => $req->extra_name[$i],
                    'extra_price' => $req->extra_price[$i],
                    'extra_qty' => $req->extra_qty[$i],
                    'extra_description' => $req->extra_description[$i],
                ]);
            }
        }

        if ($req->hasFile('images')) {

            for ($i=0; $i < count($req->images); $i++) {
                $path = uploadFile($req->images[$i],'coworking');
                CoworkingImage::create([
                    'coworking_id' => $coworking->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->back();
    }
}
