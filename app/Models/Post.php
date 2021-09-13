<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post_category() {
        return $this->belongsTo('App\Models\PostCategory');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function post_images() {
        return $this->hasMany('App\Models\PostImage');
    }

    public function post_tags() {
        return $this->hasMany('App\Models\PostTag');
    }

    public function post_poll_options() {
        return $this->hasMany('App\Models\PostPollOption');
    }
}
