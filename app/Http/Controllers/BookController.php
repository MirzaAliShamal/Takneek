<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCategory;
use App\Models\BookAuthor;
use App\Models\Book;

class BookController extends Controller
{
    public function list()
    {
        $list = Book::all();
        $book_authors = BookAuthor::all();
        $book_categories = BookCategory::all();

        return view('back.book.list',get_defined_vars());
    }

    public function add()
    {
        $book_authors = BookAuthor::all();
        $book_categories = BookCategory::all();

        return response()->json(view('back.book.add', get_defined_vars())->render(), 200);
    }

    public function edit($id = null)
    {
        $book = Book::find($id);
        $book_authors = BookAuthor::all();
        $book_categories = BookCategory::all();

        return response()->json(view('back.book.edit', get_defined_vars())->render(), 200);
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
