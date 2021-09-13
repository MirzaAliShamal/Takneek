<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\BookingExtra;
use Illuminate\Http\Request;
use App\Models\Coworking;
use App\Models\Booking;
use App\Models\Extra;
use App\Models\Event;
use App\Models\User;

class HomeController extends Controller
{
    public function managementDropdown(Request $req)
    {
        if ($req->ajax()) {
            if ($req->manage == "role") {
                $list = Role::orderBy('name', 'ASC')->get();
            } else {
                $list = User::orderBy('name', 'ASC')->get();
            }

            return view('back.ajax.management', get_defined_vars());
        } else {
            abort(404);
        }

    }

    public function getPermission(Request $req)
    {
        if ($req->ajax()) {
            if ($req->manage == "role") {
                $list = Role::orderBy('name', 'ASC')->get();
            } else {
                $list = User::orderBy('name', 'ASC')->get();
            }

            $permissions = Permission::all();

            return view('back.ajax.role_permission', get_defined_vars());
        } else {
            abort(404);
        }

    }

    public function getService(Request $req)
    {
        $list = [];
        if ($req->ajax()) {
            if ($req->type == "coworking") {
                $list = Coworking::orderBy('name', 'ASC')->get();
            }

            return view('back.ajax.service', get_defined_vars());
        } else {
            abort(404);
        }
    }

    public function getExtras(Request $req)
    {
        $list = [];
        if ($req->ajax()) {
            $coworking = Coworking::find($req->id);
            $list = $coworking->extras;

            return view('back.ajax.extras', get_defined_vars());
        } else {
            abort(404);
        }
    }

    public function getBookingCustomer(Request $req)
    {
        $list = [];
        if ($req->ajax()) {
            $booking = Booking::find($req->id);
            $customers = $booking->users;
            // dd($customers);

            return view('back.ajax.customers', get_defined_vars());
        } else {
            abort(404);
        }
    }

    public function getEventGuest(Request $req)
    {
        $list = [];
        if ($req->ajax()) {
            $event = Event::where('uuid', $req->id)->first();
            $guests = $event->event_guests;
            // dd($customers);

            return view('back.ajax.guests', get_defined_vars());
        } else {
            abort(404);
        }
    }
}
