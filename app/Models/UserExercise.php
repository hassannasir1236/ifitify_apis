<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
        'custom_workout_id',
        'name',
        'is_completed',
        'duration',
        'image',
        'exercise_id'
    ];
    protected $casts = [
        'is_completed' => 'boolean',
        'duration' => 'integer'
    ];
    /**
     * Get the video.
     */
    // public function video(): BelongsTo
    // {
    //     return $this->belongsTo(Video::class);
    // }

    /**
     * Get the user it belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }
}
