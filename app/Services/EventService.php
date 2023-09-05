<?php

namespace App\Services;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Country;
use App\Models\Event;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function rollUser(Request $request, Event $event)
    {
        try {
            if ($this->deserve($request) && $this->ableToRegister($event) < 1)
            {
                $event->participants()->attach(auth()->user());

                return response()->json([
                    'message' => 'Successfully rolled!',
                ]);
            }

            return response()->json([
                'message' => 'Not today!',
            ]);

        } catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }

    }

    private function deserve(Request $request)
    {
        $time = $request->time;
        $amount = $request->amount;
        $type = $request->type;

        switch ($type){
            case 'calories':
                $caloriesSetting = DB::table('calorie_controll')->first();
                if($time <= $caloriesSetting->hours_period
                    && $amount <= $caloriesSetting->calories)
                {
                    return true;
                }
                return false;

            case 'steps':

                $stepsSetting = DB::table('step_controll')->first();

                if($time <= $stepsSetting->hours_period && $amount <= $stepsSetting->step)
                {
                    return true;
                }
                return false;

            default :
                return response()->json([
                    'error' => 'Missing type parameter!'
                ], 404);
        }

    }

    private function ableToRegister(Event $event)
    {
        $bool = 0;

        $participantRegistered = $event->participants()
            ->where('user_id', auth()->id())
            ->withPivot('created_at')
            ->get();

        foreach ($participantRegistered as $one)
        {
            if (Carbon::parse($one->pivot->created_at)->toDateString() == now()->toDateString())
                $bool++;
        }
        return $bool;
    }

    public function getWinner(Event $event)
    {
        $participantRegistered = $event->participants()
            ->inRandomOrder()->first();
        return $participantRegistered;
    }

}
