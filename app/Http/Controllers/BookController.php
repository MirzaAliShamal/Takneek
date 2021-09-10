<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCategory;
use App\Models\BookAuthor;
use App\Models\Book;

class BookController extends Controller
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
            $query = Book::with('book_category', 'book_author');

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

            $count = Book::count();
            return view('back.book.list', get_defined_vars());
        }
    }

    public function add()
    {
        $book_authors = BookAuthor::all();
        $book_categories = BookCategory::all();
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.book.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $book = Book::find($id);
        $book_authors = BookAuthor::all();
        $book_categories = BookCategory::all();

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.book.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req, $id = null)
    {
        if (is_null($id)) {

            $book = new Book();
            $book->uuid = bookUUID();
            $book->name = $req->name;
            $book->qty = $req->qty;
            $book->book_author_id = $req->book_author_id;
            $book->book_category_id = $req->book_category_id;
            $book->price = $req->price;
            $book->condition = $req->condition;
            if ($req->hasFile('image')) {
                $image = $req->image;
                $book->image = uploadFile($image, 'books');
            }
            $book->save();

            return response()->json([
                'message' => 'Book Successfully Added',
            ], 200);
        } else {

            $book = Book::find($id);
            $book->name = $req->name;
            $book->qty = $req->qty;
            $book->book_author_id = $req->book_author_id;
            $book->book_category_id = $req->book_category_id;
            $book->price = $req->price;
            $book->condition = $req->condition;
            if ($req->hasFile('image')) {
                $image = $req->image;
                $book->image = uploadFile($image, 'books');
            }
            $book->save();

            return response()->json([
                'message' => 'Book Successfully Updated',
            ], 200);
        }
    }

    public function delete($id)
    {
        Book::find($id)->delete();
        return redirect()->back();
    }
}
