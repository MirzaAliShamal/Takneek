<?php

namespace App\Http\Controllers;

use App\Models\Extra;
use Illuminate\Http\Request;

class ExtrasController extends Controller
{
    public function list()
    {
        $list = Extra::all();
        return view('back.extra.list',get_defined_vars());
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
