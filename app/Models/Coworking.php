<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coworking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    public function coworking_extras()
    {
        return $this->hasMany('App\Models\CoworkingExtra');
    }

    public function coworking_images()
    {
        return $this->hasMany('App\Models\CoworkingImage');
    }
}
