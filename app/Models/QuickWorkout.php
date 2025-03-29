<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpseclib3\Math\PrimeField\Integer;

class QuickWorkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'name',
        'category',
        'custom_workout_id',
        'workout_duration',
        'exercises_duration',
        'video_url',
        'gif_url',
        'set',
        'exercise_each_set',
        'preparation_duration',
        'rest_between_exercises',
        'rest_between_sets'
    ];

    protected $casts = [
        'workout_duration' => 'integer',
        'exercises_duration' => 'integer',
        'preparation_duration' => 'integer',
        'rest_between_exercises' => 'integer',
        'rest_between_sets' => 'integer'
    ];
}
