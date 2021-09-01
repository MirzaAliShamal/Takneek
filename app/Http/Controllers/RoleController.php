<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function list()
    {
        $list = Role::all();
        return view('back.role.list', get_defined_vars());
    }

    public function add()
    {
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.role.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $role = Role::find($id);

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.role.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req, $id = null)
    {
        if (is_null($id)) {
            $role = new Role();
        } else {
            $role = Role::find($id);
        }
        $role->name = $req->name;
        $role->guard_name = "web";
        $role->save();

        return redirect()->back();
    }


    public function permission(Request $req)
    {
        $list=Role::all();
        $list2=User::all();
        $list3=Permission::all();
        return view('back.roles.list', get_defined_vars());
    }
    public function permissions(Request $request)
    {
        if ($request->managment=='user')
        {
            $user=User::find($request->assign_to_id);
            foreach ($request->permissions as $item)
            {
                $per=Permission::find($item)->name;

            }
            $user->givePermissionTo($per);
            return response()->json($user);

        }if ($request->managment=='role')
        {

            $role=Role::find($request->assign_to_id);
            $role->syncPermissions($request->input('permissions'));
            return response()->json($role);

        }
    }
}
