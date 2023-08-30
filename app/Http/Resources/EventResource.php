<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'                  => $this->name,
            'description'           => $this->description,
            'limit'                 => $this->limit,
            'start_registration'    => $this->start_registration,
            'end_registration'      => $this->end_registration,
            'start_event'           => $this->start_event,
            'end_event'             => $this->end_event,
            'logo'                  => $this->getFirstMediaUrl('events'),
        ];
    }
}
