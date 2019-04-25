<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // if (request()->has('q')) {
        //     // dd(request()->query('q'));
        //     $query = request()->query('q');
        //     return Event::where('title', 'ilike', "%{$query}%")
        //         ->orWhere('address', 'ilike', "%{$query}%")->get();
        // }

        $events = Event::with('categories')->filter($request)->get();

        // return response()->json($events, 200);
        return view('events.browse', compact('events'));
    }
}
