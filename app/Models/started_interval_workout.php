<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class started_interval_workout extends Model
{
    use HasFactory;
    protected $fillable = [
        'workout_id',
        'user_id',
        'type',
        'image',
        'is_completed'
    ];
}
