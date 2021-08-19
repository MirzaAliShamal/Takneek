<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function list()
    {
        $list = Location::all();
        return view('back.location.list',get_defined_vars());
    }

    public function add()
    {
        return response()->json(view('back.location.add', get_defined_vars())->render(), 200);
    }

    public function edit($id = null)
    {
        $location = Location::find($id);
        return response()->json(view('back.location.edit', get_defined_vars())->render(), 200);
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
