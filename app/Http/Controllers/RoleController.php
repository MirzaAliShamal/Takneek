<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function list(Request $req)
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
