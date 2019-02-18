<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class SearchController extends Controller
{
    public function index()
    {
        if (request()->has('q')) {
            dd('yes');
        }

        $events = Event::with('category')->get();

        return response()->json($events, 200);
    }
}
