<?php

namespace App\Http\Controllers;

use App\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with('data', collect([
            'myEvents' => auth()->user()->events ?? [],
            'savedEvents' => Event::savedEvents(),
            'myTickets' => Event::myTickets()
        ]));
    }
}
