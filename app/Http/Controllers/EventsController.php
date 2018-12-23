<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            // 'image' => 'required|image|mimes:jpeg,jpg,png,bmp',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('covers', 'public');
        }

        $event = Event::create($request->all());

        return $event;
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        return $event;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            // 'category_id' => 'required|exists:categories,id',
        ]);

        $event = Event::findOrFail($id);

        if (Gate::denies('update-event', $event)) {
            return response('Unathorized', 401);
        }

        $event->update($request->all());

        return $event;
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if (Gate::denies('delete-event', $event)) {
            return response('Unathorized', 401);
        }

        $event->delete();

        return $event;
    }
}
