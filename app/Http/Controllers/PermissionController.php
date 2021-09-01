<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function list()
    {
        $list = Permission::all();
        return view('back.permission.list', get_defined_vars());
    }

    public function add()
    {
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.permission.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $permission = Permission::find($id);

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.permission.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req, $id = null)
    {
        if (is_null($id)) {
            $permission = new Permission();
        } else {
            $permission = Permission::find($id);
        }
        $permission->name = $req->name;
        $permission->guard_name = "web";
        $permission->save();

        return redirect()->back();
    }
}
