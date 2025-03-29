<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoalUserLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_id',
        'user_level_id'
    ];

    /**
     * Get the goal it belongs to.
     */
    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }

    /**
     * Get the user level it belongs to.
     */
    public function userLevel(): BelongsTo
    {
        return $this->belongsTo(UserLevel::class);
    }
}
