<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingExtra extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function booking()
    {
        return $this->belongsTo("App\Models\Booking");
    }

    public function extra()
    {
        return $this->belongsTo("App\Models\Extra");
    }
}
