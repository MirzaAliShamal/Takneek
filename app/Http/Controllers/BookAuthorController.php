<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookAuthor;

class BookAuthorController extends Controller
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
            $query = BookAuthor::withCount('books');

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

            $count = BookAuthor::count();
            return view('back.book_author.list', get_defined_vars());
        }
    }

    public function add()
    {
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.book_author.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $book_author = BookAuthor::find($id);

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.book_author.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req, $id = null)
    {
        if (is_null($id)) {

            $author = new BookAuthor();
            $author->name = $req->name;
            if ($req->hasFile('avatar')) {
                $avatar = $req->avatar;
                $author->avatar = uploadFile($avatar, 'book_authors');
            }
            $author->save();

            return response()->json([
                'message' => 'Book Author Successfully Added',
            ], 200);
        } else {
            $author = BookAuthor::find($id);
            $author->name = $req->name;
            if ($req->hasFile('avatar')) {
                $avatar = $req->avatar;
                $author->avatar = uploadFile($avatar, 'book_authors');
            }
            $author->save();

            return response()->json([
                'message' => 'Book Author Successfully Updated',
            ], 200);
        }
    }

    public function delete($id)
    {
        BookAuthor::find($id)->delete();
        return redirect()->back();
    }
}
