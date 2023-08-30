<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;

class EventController extends Controller
{
    public EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->authorizeResource(Event::class,'event');
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json([
               $this->eventService->index(),
            ]);
        }catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        try {
            return response()->json([
                EventResource::make($this->eventService->store($request)),
            ]);
        }catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        try {
            return response()->json([
                EventResource::make($this->eventService->show($event)),
            ]);
        }catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        try {
            return response()->json([
                EventResource::make($this->eventService->update($request, $event)),
            ]);
        }catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            return response()->json([
               'delete_status' => $this->eventService->delete($event),
            ]);
        }catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
