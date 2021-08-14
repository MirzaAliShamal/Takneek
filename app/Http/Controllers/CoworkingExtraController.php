<?php

namespace App\Http\Controllers;

use App\Models\CoworkingExtra;
use Illuminate\Http\Request;

class CoworkingExtraController extends Controller
{
    public function save(Request $request)
    {

        $data=CoworkingExtra::create([
           'name'=>$request->e_name,
           'price'=>$request->e_price,
           'duration'=>$request->e_duration,
           'qty'=>$request->e_qty,
           'desc'=>$request->e_desc,
        ]);
        return response()->json($data);
    }
    public function delete($id)
    {
            CoworkingExtra::find($id)->delete();
            return response()->json('extra delete');
    }
}
