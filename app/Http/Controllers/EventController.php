<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\EventCategory;
use App\Models\Organizer;
use App\Models\Pass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Termwind\Components\Dd;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Event/Index', [
            'events' => Organizer::getOrganizerEvents(auth()->user()->organizer ? auth()->user()->organizer->id : null),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Event/Create', [
            'eventCategories' => EventCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $picture_name = auth()->user()->name . '_' . $request->title . '.' . $request->file('picture')->extension();
        $picture_path = env('APP_URL') . "/storage" . '/' . $request->file('picture')->storeAs('event_picture', $picture_name, 'public');
        $event = Event::create([
            'picture_path' => $picture_path,
            'organizer_id' => auth()->user()->organizer->id,
            ...$request->except('picture')
        ]);
        return redirect()->route('event.index')->with('flash.success', 'Evenement creer !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Inertia::render('Event/Show', [
            'event' => Event::getEventDetails($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $event = Event::find($event->id);
        return Inertia::render('Event/Edit', [
            'eventCategories' => EventCategory::all(),
            'event' => $event,
            'passes' => $event->passes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $picture_path = null;
        if (false) {
            $picture_name = auth()->user()->name . '_' . $request->title . '.' . $request->file('picture')->extension();
            $picture_path = env('APP_URL') . "/storage" . '/' . $request->file('picture')->storeAs('event_picture', $picture_name, 'public');
        }
        $event->update([
            'picture_path' => $picture_path ? $picture_path : $event->picture_path,
            'organizer_id' => auth()->user()->organizer->id,
            ...$request->except('picture')
        ]);
        $event->save();
        return redirect()->route('event.index')->with('flash.success', 'Evenement mis a jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::destroy($id);
        return redirect()->route('event.index')->with('flash.success', 'Evenement supprimer !');
    }

    /**
     * 
     */
    public function rechercheEvenements(Request $request)
    {
        return Inertia::render('Home/Index', [
            'events' => $request->get('q') ? Event::searchEvents($request->get('q')) : Event::getIncomingEvents(12)
        ]);
    }
}
