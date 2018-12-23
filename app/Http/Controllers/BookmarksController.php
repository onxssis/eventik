<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class BookmarksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $event = Event::findOrFail($request->event_id);

        return auth()->user()->addToBookmarks($event);
    }

    public function destroy(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        return auth()->user()->removeFromBookmarks($event);
    }
}
