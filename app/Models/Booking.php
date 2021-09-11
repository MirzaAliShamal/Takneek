<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookingable()
    {
        return $this->morphTo();
    }

    public function coworking()
    {
        return $this->belongsTo("App\Models\Coworking");
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function booking_extras()
    {
        return $this->hasMany("App\Models\BookingExtra");
    }

    public function booking_appointments()
    {
        return $this->hasMany("App\Models\BookingAppointment");
    }
}
