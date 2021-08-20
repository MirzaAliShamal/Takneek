<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookAuthor;

class BookAuthorController extends Controller
{
    public function list()
    {
        $list = BookAuthor::all();
        return view('back.book_author.list',get_defined_vars());
    }

    public function add()
    {
        return response()->json(view('back.book_author.add', get_defined_vars())->render(), 200);
    }

    public function edit($id = null)
    {
        $book_author = BookAuthor::find($id);
        return response()->json(view('back.book_author.edit', get_defined_vars())->render(), 200);
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
