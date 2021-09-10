<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventImage;
use App\Models\EventGuest;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function list(Request $req)
    {
        $count = Event::count();

        return view('back.event.list', get_defined_vars());
    }

    public function add(Request $req)
    {
        $users = User::orderBy('name', 'asc')->get();

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.event.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $event = Event::find($id);
        $users = User::orderBy('name', 'asc')->get();

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.event.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req, $id = null)
    {
        dd($req);

        $event = new Event();
        $event->title = $req->title;
        $event->detail = $req->detail;
        $event->date = $req->date;
        $event->time = $req->time;
        $event->host = $req->host;
        $event->max_seats = $req->max_seats;
        $event->max_allowed_booking = $req->max_allowed_booking;
        $event->price = $req->price;
        $event->location = $req->location;
        $event->recurring_event = $req->recurring_event == "on" ? 1 : 0;
        $event->recurring_type = $req->recurring_type;
        $event->recurring_interval = $req->recurring_interval;
        $event->recurring_until = $req->recurring_until;
        $event->no_of_guests = $req->no_of_guests;
        $event->save();

        return redirect()->back();
    }

    public function delete($id = null)
    {
        Event::find($id)->delete();
        return redirect()->back();
    }
}
