<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_enabled',
        'icon'
    ];

    /**
     * Get the users belonging to the goal.
     */
    // public function users(): HasMany
    // {
    //     return $this->hasMany(User::class);
    // }
    public function users(): BelongsToMany 
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the training levels belonging to the goal.
     */
    public function trainingLevels(): HasMany
    {
        return $this->hasMany(GoalLevel::class);
    }

    /**
     * Get the user levels belonging to the goal.
     */
    public function userLevels(): HasMany
    {
        return $this->hasMany(GoalUserLevel::class);
    }
    public function goal_userLevels()
    {
        return $this->belongsToMany(UserLevel::class, 'goal_user_levels', 'goal_id', 'user_level_id')
                    ->withTimestamps();
    }

    public function goal_trainingLevels()
    {
        return $this->belongsToMany(TrainingLevel::class, 'goal_levels', 'goal_id', 'training_level_id')
                    ->withTimestamps();
    }
}
