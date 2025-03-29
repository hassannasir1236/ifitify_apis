<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'exercise_category_id',
        'training_level_id',
        'exercise_equipment_id',
        'batch_id',
        'batch_type',
        'type',
        'video_url',
        'image_url',
        'instructions',
        'thumbnail',
        'user_level',
        'goal_id',
        'belong_to_set'
    ];

    /**
     * Get the category it belongs to.
     */
    public function exerciseCategory(): BelongsTo
    {
        return $this->belongsTo(ExerciseCategory::class);
    }

    /**
     * Get the equipment it belongs to.
     */
    public function exerciseEquipmet(): BelongsTo
    {
        return $this->belongsTo(ExerciseEquipment::class);
    }

    /**
     * Get the vidoes associated with the exercise.
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Get the usr workout logs associated with the exercise.
     */
    public function workoutLogs(): HasMany
    {
        return $this->hasMany(UserWorkoutLog::class);
    }
}
