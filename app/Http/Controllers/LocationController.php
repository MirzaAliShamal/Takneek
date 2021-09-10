<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function list(Request $req)
    {
        if ($req->ajax()) {
            $page = 1;
            $per_page = 10;

            // Define the default order
            $order_field = 'location';
            $order_sort = 'asc';

            // Get the request parameters
            $params = $req->all();
            $query = Location::query();

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

            $count = Location::count();
            return view('back.location.list', get_defined_vars());
        }
    }

    public function add()
    {
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.location.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $location = Location::find($id);

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.location.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $request, $id = null)
    {
        if (is_null($id)) {
            Location::create($request->except('_token'));

            return response()->json([
                'message' => 'Location Successfully Added',
            ], 200);
        } else {
            Location::find($id)->update($request->except('_token'));

            return response()->json([
                'message' => 'Location Successfully Updated',
            ], 200);
        }
    }

    public function delete($id)
    {
        Location::find($id)->delete();
        return redirect()->back();
    }
}
