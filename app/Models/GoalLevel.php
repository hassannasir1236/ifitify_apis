<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoalLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_id',
        'is_enabled',
        'training_levels_id'
    ];

    /**
     * Get the goal it belongs to.
     */
    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }

     /**
     * Get the level it belongs to.
     */
    // public function trainingLevel(): BelongsTo
    // {
    //     return $this->belongsTo(TrainingLevel::class);
    // }
    public function trainingLevel(): BelongsTo
    {
        return $this->belongsTo(TrainingLevel::class, 'training_level_id');
    }

}
