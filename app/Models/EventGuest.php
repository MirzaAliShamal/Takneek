<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGuest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function event() {
        return $this->belongsTo('App\Models\EventImage');
    }
}
