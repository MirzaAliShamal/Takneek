<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCategory;

class PostCategoryController extends Controller
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
            // $query = PostCategory::withCount('posts');
            $query = PostCategory::query();

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

            $count = PostCategory::count();
            return view('back.post_category.list', get_defined_vars());
        }
    }

    public function add()
    {
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.post_category.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $post_category = PostCategory::find($id);

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.post_category.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $request, $id = null)
    {
        if (is_null($id)) {
            PostCategory::create($request->except('_token'));

            return response()->json([
                'message' => 'Post Category Successfully Added',
            ], 200);
        } else {
            PostCategory::find($id)->update($request->except('_token'));

            return response()->json([
                'message' => 'Post Category Successfully Updated',
            ], 200);
        }
    }

    public function delete($id)
    {
        PostCategory::find($id)->delete();
        return redirect()->back();
    }
}
