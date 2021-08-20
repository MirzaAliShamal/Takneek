<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function book_author()
    {
        return $this->belongsTo('App\Models\BookAuthor');
    }

    public function book_category()
    {
        return $this->belongsTo('App\Models\BookCategory');
    }
}
