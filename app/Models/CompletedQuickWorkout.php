<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedQuickWorkout extends Model
{
    use HasFactory;
    protected $table = 'completed_quick_workouts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'workout_id',
        'batch_id',
        'type',
        'is_completed',
    ];
    public $timestamps = true;
}
