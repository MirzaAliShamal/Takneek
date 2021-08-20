<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoworkingExtra extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function coworking()
    {
        return $this->belongsTo('App\Models\Coworking');
    }
}
