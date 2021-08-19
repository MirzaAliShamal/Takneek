<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    public function managementDropdown(Request $req)
    {
        if ($req->ajax()) {
            if ($req->manage == "role") {
                $list = Role::orderBy('name', 'ASC')->get();
            } else {
                $list = User::orderBy('name', 'ASC')->get();
            }

            return view('back.ajax.management', get_defined_vars());
        } else {
            abort(404);
        }

    }

    public function getPermission(Request $req)
    {
        if ($req->ajax()) {
            if ($req->manage == "role") {
                $list = Role::orderBy('name', 'ASC')->get();
            } else {
                $list = User::orderBy('name', 'ASC')->get();
            }

            $permissions = Permission::all();

            return view('back.ajax.role_permission', get_defined_vars());
        } else {
            abort(404);
        }

    }
}
