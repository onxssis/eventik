<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Reservation;

class ReservationController extends Controller
{
    public function store($eventSlug)
    {
        $event = Event::where('slug', $eventSlug)->firstOrFail();

        auth()->user()->attend($event->id);

        return $event;
    }

    public function destroy($eventSlug)
    {
        $event = Event::where('slug', $eventSlug)->firstOrFail();

        auth()->user()->unattend($event->id);

        return $event;
    }
}
