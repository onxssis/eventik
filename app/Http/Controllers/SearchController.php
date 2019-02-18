<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::with('category')->filter($request)->get();

        return response()->json($events, 200);
    }
}
