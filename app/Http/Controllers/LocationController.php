<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function list()
    {
        $list=Location::all();
        return view('back.location.list',get_defined_vars());
    }
    public function save(Request $request)
    {
        Location::create($request->all());
        return redirect()->back();
    }
    public function delete($id)
    {
        Location::find($id)->delete();
        return redirect()->back();
    }
}
