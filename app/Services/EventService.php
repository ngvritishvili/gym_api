<?php

namespace App\Services;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Product;

class EventService
{
    public function index()
    {
        return Event::with('owner')->get();
    }

    public function show(Event $event)
    {
        return $event;
    }

    public function create()
    {
        return Event::select('name')->get();
    }

    public function store(StoreEventRequest $request)
    {
        $event = Product::create($request->validated());
        auth()->user()->products()->save($event);

        return $event;
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return $event;
    }

    public function delete(Event $event)
    {
        return $event->delete();
    }

}
