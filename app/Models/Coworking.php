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

    public function extras()
    {
        return $this->belongsToMany('App\Models\Extra');
    }

    public function coworking_images()
    {
        return $this->hasMany('App\Models\CoworkingImage');
    }

    public function bookings()
    {
        return $this->morphMany('App\Models\Booking', 'bookingable');
    }
}
