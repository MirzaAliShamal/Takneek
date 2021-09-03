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
        if ($req->ajax()) {
            $page = 1;
            $per_page = 10;

            // Define the default order
            $order_field = 'name';
            $order_sort = 'asc';

            // Get the request parameters
            $params = $req->all();
            $query = User::with('roles')->where('id', '!=', auth()->user()->id);

            // Set the current page
            if(isset($params['pagination']['page'])) {
                $page = $params['pagination']['page'];
            }

            // Set the number of items
            if(isset($params['pagination']['perpage'])) {
                $per_page = $params['pagination']['perpage'];
            }

            // Set the search filter
            if(isset($params['query']['generalSearch'])) {
                $query->where('name', 'LIKE', "%" . $params['query']['generalSearch'] . "%")
                ->orWhere('file', 'LIKE', "%" . $params['query']['generalSearch'] . "%");
            }

            // Get how many items there should be
            $total = $query->limit($per_page)->count();

            // Get the items defined by the parameters
            $results = $query->skip(($page - 1) * $per_page)->take($per_page)->orderBy($order_field, $order_sort)->get();

            $roles = Role::all();

            $data = [
                'meta' => [
                    "page" => $page,
                    "pages" => ceil($total / $per_page),
                    "perpage" => $per_page,
                    "total" => $total,
                    "sort" => $order_sort,
                    "field" => $order_field
                ],

                'data' => $results
            ];
            return response()->json($data, 200);
        } else {
            $count = User::where('id', '!=', auth()->user()->id)->count();
            return view('back.user.list', get_defined_vars());
        }

    }

    public function add()
    {
        $roles = Role::all();
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.user.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $roles = Role::all();
        $user = User::find($id);

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.user.edit', get_defined_vars())->render(),
        ]);
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
            if (is_null($id)) {
                $user->profile_picture = "default.png";
            }
        }
        $user->save();

        $user->roles()->detach();
        $user->assignRole($req->role);

        return redirect()->back();

    }

    public function delete($id)
    {
        User::find($id)->delete();

        return redirect()->back();
    }

}
