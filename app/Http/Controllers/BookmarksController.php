<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Bookmark;

class BookmarksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($id)
    {
        $event = Event::findOrFail($id);

        Bookmark::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
        ]);

        return $event;
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        Bookmark::where('event_id', $event->id)->first()->delete();

        return $event;
    }
}
