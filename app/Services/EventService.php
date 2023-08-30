<?php

namespace App\Services;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Country;
use App\Models\Event;
use App\Models\Product;

class EventService
{
    public function index()
    {
        return Event::with('participants')->get();
    }

    public function show(Event $event)
    {
        return $event;
    }

    public function create()
    {
        return Country::select('name')->get();
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->validated());

        if ($request->hasFile('logo')) {
            $event->addMediaFromRequest('logo')
                ->toMediaCollection('events');
        }

        return $event;
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());
        $image = $request->file('logo');
        if ($image) {
            $event->clearMediaCollection('events');
            $event->addMedia($image)->toMediaCollection('events');
        }

        return $event;
    }

    public function delete(Event $event)
    {
        return $event->delete();
    }

}
