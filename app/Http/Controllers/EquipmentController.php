<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function list(Request $req)
    {
        if ($req->ajax()) {
            $page = 1;
            $per_page = 10;

            // Define the default order
            $order_field = 'name';
            $order_sort = 'asc';

            // Get the request parameters
            $params = $req->all();
            $query = Equipment::query();

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

            $count = Equipment::count();
            return view('back.equipment.list', get_defined_vars());
        }
    }

    public function add()
    {
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.equipment.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $equipment = Equipment::find($id);

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.equipment.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req, $id = null)
    {
        if (is_null($id)) {

            $eqp = new Equipment();
            $eqp->name = $req->name;
            $eqp->qty = $req->qty;
            $eqp->price = $req->price;
            if ($req->hasFile('image')) {
                $image = $req->image;
                $eqp->image = uploadFile($image, 'equipments');
            }
            $eqp->save();

            return response()->json([
                'message' => 'Equipment Successfully Added',
            ], 200);
        } else {

            $eqp = Equipment::find($id);
            $eqp->name = $req->name;
            $eqp->qty = $req->qty;
            $eqp->price = $req->price;
            if ($req->hasFile('image')) {
                $image = $req->image;
                $eqp->image = uploadFile($image, 'equipments');
            }
            $eqp->save();

            return response()->json([
                'message' => 'Equipment Successfully Updated',
            ], 200);
        }
    }

    public function delete($id)
    {
        Equipment::find($id)->delete();
        return redirect()->back();
    }
}
