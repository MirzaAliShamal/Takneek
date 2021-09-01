<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function list()
    {
        $list = Equipment::all();

        return view('back.equipment.list',get_defined_vars());
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
