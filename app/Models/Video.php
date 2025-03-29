<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'exercise_id',
        'exercise_category_id',
        'training_level_id',
        'exercise_equipment_id',
        'video_url',
        'instructions',
        'image_url'
    ];

    /**
     * Get the category it belongs to.
     */
    public function exerciseCategory(): BelongsTo
    {
        return $this->belongsTo(ExerciseCategory::class);
    }

    /**
     * Get the training level it belongs to.
     */
    public function trainingLevel(): BelongsTo
    {
        return $this->belongsTo(TrainingLevel::class);
    }

    /**
     * Get the exercise equipment used for the video.
     */
    public function exerciseEquipment(): BelongsTo
    {
        return $this->belongsTo(ExerciseEquipment::class);
    }

    /**
     * Get the exercise the video belongs to.
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

}
