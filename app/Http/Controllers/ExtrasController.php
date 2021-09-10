<?php

namespace App\Http\Controllers;

use App\Models\Extra;
use Illuminate\Http\Request;

class ExtrasController extends Controller
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
            $query = Extra::query();

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

            $count = Extra::count();
            return view('back.extra.list', get_defined_vars());
        }
    }

    public function add()
    {
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.extra.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $extra = Extra::find($id);

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.extra.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req, $id = null)
    {
        if (is_null($id)) {

            $extra = new Extra();
            $extra->name = $req->name;
            $extra->price = $req->price;
            $extra->qty = $req->qty;
            $extra->description = $req->description;
            if ($req->hasFile('image')) {
                $image = $req->image;
                $extra->image = uploadFile($image, 'extras');
            }
            $extra->save();

            return response()->json([
                'message' => 'Extra Successfully Added',
            ], 200);
        } else {
            $extra = Extra::find($id);
            $extra->name = $req->name;
            $extra->price = $req->price;
            $extra->qty = $req->qty;
            $extra->description = $req->description;
            if ($req->hasFile('image')) {
                $image = $req->image;
                $extra->image = uploadFile($image, 'extras');
            }
            $extra->save();

            return response()->json([
                'message' => 'Extra Successfully Updated',
            ], 200);
        }
    }

    public function delete($id)
    {
        Extra::find($id)->delete();
        return redirect()->back();
    }
}
