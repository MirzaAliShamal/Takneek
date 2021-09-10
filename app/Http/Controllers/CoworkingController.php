<?php

namespace App\Http\Controllers;

use App\Models\Coworking;
// use App\Models\CoworkingExtra;
use App\Models\CoworkingImage;
use App\Models\Location;
use App\Models\Extra;
use Illuminate\Http\Request;

class CoworkingController extends Controller
{
    public function list(Request $req)
    {
        if ($req->ajax()) {
            $page = 1;
            $per_page = 10;

            // Define the default order
            $order_field = 'id';
            $order_sort = 'desc';

            // Get the request parameters
            $params = $req->all();
            $query = Coworking::with('coworking_images', 'location');

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

            // Get how many items there should be
            $total = $query->limit($per_page)->count();

            // Get the items defined by the parameters
            $results = $query->skip(($page - 1) * $per_page)->take($per_page)->orderBy($order_field, $order_sort)->get();

            $data = [
                'meta' => [
                    "page" => $page,
                    "pages" => ceil($total / $per_page),
                    "perpage" => $per_page,
                    "total" => $total,
                    "sort" => $order_sort,
                    "field" => $order_field
                ],

                'data' => $results
            ];
            return response()->json($data, 200);
        } else {

            $count = Coworking::count();
            return view('back.coworking.list', get_defined_vars());
        }
    }

    public function add()
    {
        $locations = Location::all();
        $extras = Extra::select('id AS id', 'name AS value', 'image As pic','qty AS qty')->orderBy('name', 'ASC')->get()->toArray();

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.coworking.add', get_defined_vars())->render(),
            'tagify' => $extras,
        ]);
    }

    public function edit($id = null)
    {
        $locations = Location::all();
        $coworking = Coworking::with('coworking_images')->find($id);
        $extras = Extra::select('id AS id', 'name AS value', 'image As pic','qty AS qty')->orderBy('name', 'ASC')->get()->toArray();

        // dd(implode(", ", $coworking->extras()->pluck('name')->toArray()));
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.coworking.edit', get_defined_vars())->render(),
            'tagify' => $extras,
        ]);
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
        $coworking->status = 1;
        $coworking->save();


        if(isset($req->extras)) {
            $cur_ids = array();
            foreach($coworking->extras as $e){
                $cur_ids[] = $e->id;
            }
            $coworking->extras()->detach($cur_ids);

            $ids = [];
            foreach (json_decode($req->extras) as $value) {
                $ids[] = $value->id;
            }
            $extras = Extra::find($ids);
            $coworking->extras()->attach($extras);
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
