<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function event_images() {
        return $this->hasMany('App\Models\EventImage');
    }

    public function event_guests() {
        return $this->hasMany('App\Models\EventGuest');
    }
}
