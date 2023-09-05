<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WinnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'                  => $this->username,
            'email'                 => $this->email,
            'ticket_of_the_day'     => Carbon::parse($this->pivot->created_at)->toDateString(),
        ];
    }
}
