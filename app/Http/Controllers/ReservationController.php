<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $event = Event::findOrFail($request->event);

        Reservation::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
        ]);

        return back()->with(['success' => 'Registration successful']);
    }

    public function destroy(Request $request)
    {
        $reservation = Reservation::where('event_id', $request->event)->first();

        $reservation->delete();

        return back();
    }
}
