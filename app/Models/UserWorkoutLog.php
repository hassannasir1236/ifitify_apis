<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWorkoutLog extends Model
{
    use HasFactory;

    protected $fillable = ['exercise_id','workout_log_title', 'user_id', 'set', 'reps', 'kg','comment','is_completed', 'rest_time', 'workout_id','workout_exercise_id'];

    protected $casts = [
        'is_completed' => 'boolean',
    ];
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
