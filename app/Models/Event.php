<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'limit',
        'start_registration',
        'end_registration',
        'start_event',
        'end_event',
    ];

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'event_user','event_id','user_id')
            ->withTimestamps();
    }
}
