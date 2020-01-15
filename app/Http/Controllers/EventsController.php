<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use App\Http\Requests\StoreEvent;
use App\Http\Requests\UpdateEvent;
use App\Repositories\Event\IEventRepository;

class EventsController extends Controller
{
    protected $repo;

    public function __construct(IEventRepository $repo)
    {
        $this->repo = $repo;
        $this->middleware('auth')->except(['show', 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = geoip()->getLocation();
        $point = null;

        if ('127.0.0.0' !== $location['ip']) {
            $point = "{$location['lat']}, {$location['lon']}";
        }

        dd($point);

        $events = $this->repo->getUpcomingEvents(4);
        $eventsNearby = $this->repo->getEventsNearby($point);

        return view('welcome', compact('events', 'eventsNearby'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(['id', 'name']);

        return view('events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvent $request)
    {
        $request->uploadEventImage()
            ->persist()
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvent $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->updateEvent($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->authorize('update', $event);

        $event->delete();

        return $event;
    }
}
