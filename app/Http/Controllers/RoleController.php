<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function list(Request $req)
    {
        return view('back.roles.list', get_defined_vars());
    }
}
