<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManageUserController extends Controller
{
    public function list(Request $req)
    {
        $list = User::orderBy('id','desc')->get();

        return view('back.users.list', get_defined_vars());
    }
    public function save(Request $req)
    {

        $validate=$this->validate($req,[
            'profile_picture'=>'required',
            'email'=>'required|unique:users',
            'name'=>'required',
            'password'=>'required',
        ]);

        if ($req->hasFile('id_proof'))
        {
            $file1=$req->id_proof;
            $value1=uploadFile($file1, 'user_images');
        }
        if ($req->hasFile('profile_picture'))
        {
            $file2=$req->profile_picture;
            $value2=uploadFile($file2, 'user_images');
        }
        $user=User::create([
           'name'=>$req->name,
           'email'=>$req->email,
           'password'=>$req->password,
           'mobile_no'=>$req->mobile_no,
           'id_proof'=>$value1 ?? 'N/A',
           'profile_picture'=>$value2 ??'N/A',
           'website'=>$req->website,
           'facebook'=>$req->facebook,
           'instagram'=>$req->instagram,
           'twitter'=>$req->twitter,
           'youtube'=>$req->youtube,
           'company'=>$req->company,
        ]);
        $view=view('back.users.ajax.user_table',['item'=>$user]);
        return response()->json($user);

    }
    public function delete($id)
    {
        User::find($id)->delete();
        return response()->json('delete');
    }

}
