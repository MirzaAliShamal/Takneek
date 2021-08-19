<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManageUserController extends Controller
{
    public function list(Request $req)
    {
        $roles = Role::all();
        $list = User::where('id', '!=', auth()->user()->id)->orderBy('id','desc')->get();

        return view('back.user.list', get_defined_vars());
    }

    public function add()
    {
        $roles = Role::all();

        return response()->json(view('back.user.add', get_defined_vars())->render(), 200);
    }

    public function edit($id = null)
    {
        $roles = Role::all();
        $user = User::find($id);

        return response()->json(view('back.user.edit', get_defined_vars())->render(), 200);
    }

    public function save(Request $req, $id = null)
    {
        if (is_null($id)) {
            $user = new User();
        } else {
            $user = User::find($id);
        }
        $user->name = $req->name;
        $user->email = $req->email;
        if (is_null($id)) {
            $user->password = Hash::make("12345678");
        }
        $user->mobile_no = $req->mobile_no;
        $user->website = $req->website;
        $user->facebook = $req->facebook;
        $user->instagram = $req->instagram;
        $user->twitter = $req->twitter;
        $user->youtube = $req->youtube;
        $user->company = $req->company;
        if ($req->hasFile('profile_picture')) {
            $profile = $req->profile_picture;
            $user->profile_picture = uploadFile($profile, 'user_images');
        } else {
            $user->profile_picture = "default.png";
        }
        $user->save();


        $user->assignRole($req->role);

        return redirect()->back();


        // sendMail([
        //     'view' => 'email.admin.sub_admin',
        //     'to' => $user->email,
        //     'subject' => 'Your profile has been created',
        //     'name' => 'Laravel',
        //     'data' => [
        //         'name' => $user->name,
        //         'email' => $user->email,
        //         'password' => $req->password,
        //     ]
        // ]);

    }

    public function delete($id)
    {
        User::find($id)->delete();
        return response()->json('delete');
    }

}
