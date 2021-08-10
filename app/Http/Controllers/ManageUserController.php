<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManageUserController extends Controller
{
    public function list(Request $req)
    {
        $list = User::whereHas('roles')->orderBy('created_at', 'DESC')->get();

        return view('back.users.list', get_defined_vars());
    }
}
