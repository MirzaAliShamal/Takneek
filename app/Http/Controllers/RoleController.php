<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
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
            $query = Role::withCount('users', 'permissions');

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

            $count = Role::count();
            return view('back.role.list', get_defined_vars());
        }
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

    public function delete($id = null)
    {
        Role::find($id)->delete();

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
