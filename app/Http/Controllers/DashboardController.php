<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('back.dashboard', get_defined_vars());
    }

    public function managePermission(Request $req)
    {
        if ($req->ajax()) {
            if ($req->manage == "role") {
                $permission = Permission::find($req->permission);
                $role = Role::find($req->assign_to_id);

                $check = DB::table('role_has_permissions')->where('role_id', $req->assign_to_id)->where('permission_id', $req->permission)->first();

                if ($check) {
                    $role->revokePermissionTo($permission->name);
                } else {
                    $role->givePermissionTo($permission->name);
                }
            } else {
                $permission = Permission::find($req->permission);
                $user = User::find($req->assign_to_id);

                $check = DB::table('model_has_permissions')->where('model_id', $req->assign_to_id)->where('permission_id', $req->permission)->first();

                if ($check) {
                    $user->revokePermissionTo($permission->name);
                } else {
                    $user->givePermissionTo($permission->name);
                }
            }


            return response()->json([
                'statusCode' => 200,
                'message' => 'Permissions Updated Successfully!',
            ]);
        } else {
            $users = User::orderBy('name', 'ASC')->get();
            $roles = Role::orderBy('name', 'ASC')->get();
            $permissions = Permission::all();

            return view('back.role_permission', get_defined_vars());
        }
    }
}
