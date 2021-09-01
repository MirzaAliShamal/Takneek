<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function coworkings()
    {
        return $this->belongsToMany('App\Models\Coworking');
    }
}
