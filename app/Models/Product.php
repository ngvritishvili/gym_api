<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'weight',
        'price',
        'quantity',
        'image',
        'name',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
