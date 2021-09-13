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
        if ($req->ajax()) {
            $page = 1;
            $per_page = 10;

            // Define the default order
            $order_field = 'id';
            $order_sort = 'desc';

            // Get the request parameters
            $params = $req->all();
            $query = Event::with('event_images', 'event_guests');

            // Set the current page
            if(isset($params['pagination']['page'])) {
                $page = $params['pagination']['page'];
            }

            // Set the number of items
            if(isset($params['pagination']['perpage'])) {
                $per_page = $params['pagination']['perpage'];
            }

            // Set the search filter
            if(isset($params['query']['generalSearch'])) {
                $query->where('name', 'LIKE', "%" . $params['query']['generalSearch'] . "%")
                ->orWhere('file', 'LIKE', "%" . $params['query']['generalSearch'] . "%");
            }

            // Get how many items there should be
            $total = $query->limit($per_page)->count();

            // Get the items defined by the parameters
            $results = $query->skip(($page - 1) * $per_page)->take($per_page)->orderBy($order_field, $order_sort)->get();

            $data = [
                'meta' => [
                    "page" => $page,
                    "pages" => ceil($total / $per_page),
                    "perpage" => $per_page,
                    "total" => $total,
                    "sort" => $order_sort,
                    "field" => $order_field
                ],

                'data' => $results
            ];
            return response()->json($data, 200);
        } else {
            $count = Event::count();
            return view('back.event.list', get_defined_vars());
        }

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
        $event = Event::with('event_images', 'event_guests')->find($id);
        $users = User::orderBy('name', 'asc')->get();

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.event.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req, $id = null)
    {
        $event = new Event();
        $event->uuid = eventUUID();
        $event->title = $req->title;
        $event->detail = $req->detail;
        $event->date = $req->date;
        $event->time = $req->time;
        $event->host = $req->host;
        $event->max_seats = $req->max_seats;
        $event->max_allowed_booking = $req->max_allowed_booking;
        $event->price = $req->price;
        $event->location = $req->location;
        $event->recurring_appointment = $req->recurring_appointment;
        $event->unavailable_recurring_dates = $req->unavailable_recurring_dates;
        $event->recurring_appointment_payments = $req->recurring_appointment_payments;
        $event->no_of_guests = $req->no_of_guests;
        $event->save();

        if ($event) {
            if (isset($req->images)) {
                $event->event_images()->delete();
                for ($i=0; $i < count($req->images) ; $i++) {
                    $event_image = new EventImage();
                    $event_image->event_id = $event->id;
                    $event_image->path = uploadFile($req->images[$i],'events');
                    $event_image->save();
                }
            }

            $event->event_guests()->delete();
            if ((int)$req->no_of_guests > 0) {
                for ($i=0; $i < (int)$req->no_of_guests ; $i++) {
                    $event_guest = new EventGuest();
                    $event_guest->event_id = $event->id;
                    $event_guest->image = uploadFile($req->image[$i],'event_guests');
                    $event_guest->name = $req->name[$i];
                    $event_guest->save();
                }
            }
        }

        return redirect()->back();
    }

    public function delete($id = null)
    {
        Event::find($id)->delete();
        return redirect()->back();
    }
}
