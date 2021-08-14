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
        $list=Coworking::orderBY('id','desc')->get();
        $locations=Location::all();
        return view('back.coworking.list',get_defined_vars());
    }
    public function page_coworking()
    {
        $list=Coworking::orderBY('id','desc')->get();
        $locations=Location::all();
        return view('back.coworking.page-coworkings',get_defined_vars());
    }

    public function save(Request $request)
    {


        $request->validate([
            'name'=>'required',
        ]);


        if ($request->hasFile('first_img'))
        {
            $file=$request->first_img;
            $value=uploadFile($file,'coworking');
        }

       $coworking= Coworking::create([
            'name'=>$request->name,
            'location'=>$request->location,
            'duration'=>$request->duration,
            'price'=>$request->price,
            'buffer_before_time'=>$request->buffer_before_time,
            'buffer_after_time'=>$request->buffer_after_time,
            'min_capacity'=>$request->min_capacity,
            'max_capacity'=>$request->max_capacity,
            'recurring_appointment'=>$request->recurring_appointment,
            'description'=>$request->description,
            'first_img'=>$value??' ',
            'total_extra'=>count((array)$request->extra_id)??' ',
            'req_extra'=>$request->req_extra??' ',
            'service_on_site'=>$request->service_on_site??'no',
            'price_multiple_by_number'=>$request->price_multiple_by_number??'no',
            'Bringing_anyone_with_you'=>$request->Bringing_anyone_with_you??'no',
            'extra_mandatory'=>$request->extra_mandatory??'no',
        ]);


        if(count((array)$request->extra_id)>0)
        {
            foreach ($request->extra_id as $extra_id)
            {
                $extra=CoworkingExtra::find($extra_id);
                $extra->coworking_id=$coworking->id;
                $extra->save();
            }
        }

        if ($request->hasFile('images'))
        {
            foreach($request->images as $image)
            {

                $value1=uploadFile($image,'coworking');
                CoworkingImage::create([
                    'image'=>$value1 ??' ',
                    'coworking_id'=>$coworking->id,
                ]);
            }

        }

        return redirect()->back();
    }
}
