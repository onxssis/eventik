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

    public function store(Request $request)
    {
        $event = Event::findOrFail($request->event);

        Bookmark::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
        ]);

        return back();

        // return auth()->user()->addToBookmarks($event);
    }

    public function destroy(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        Bookmark::where('event_id', $event->id)->first()->delete();

        return back();
    }
}
