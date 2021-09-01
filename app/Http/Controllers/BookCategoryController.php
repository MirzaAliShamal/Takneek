<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCategory;

class BookCategoryController extends Controller
{
    public function list()
    {
        $list = BookCategory::all();
        return view('back.book_category.list',get_defined_vars());
    }

    public function add()
    {
        return response()->json([
            'statusCode' => 200,
            'html' => view('back.book_category.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $book_category = BookCategory::find($id);

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.book_category.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $request, $id = null)
    {
        if (is_null($id)) {
            BookCategory::create($request->except('_token'));

            return response()->json([
                'message' => 'Book Category Successfully Added',
            ], 200);
        } else {
            BookCategory::find($id)->update($request->except('_token'));

            return response()->json([
                'message' => 'Book Category Successfully Updated',
            ], 200);
        }
    }

    public function delete($id)
    {
        BookCategory::find($id)->delete();
        return redirect()->back();
    }
}
