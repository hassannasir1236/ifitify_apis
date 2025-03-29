<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserIntervalWorkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
        'interval_workout_name',
        'interval_workout_id' ,
        'full_screen_duration' ,
        'preparation_duration',
        'rest_between_sets',
        'rest_between_exercises',
        'number_of_exercises',
        'number_of_sets',
        'image',
        'interval_workout_type',
        'is_completed',
        'exercises_duration'
    ];
    protected $casts = [
        'full_screen_duration' => 'integer',
        'preparation_duration' => 'integer',
        'rest_between_events' => 'integer'
    ];
    /**
     * Get the video.
     */
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    /**
     * Get the user it belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quickWorkout(): BelongsTo
    {
        return $this->belongsTo(QuickWorkout::class,'video_id');
    }
}
