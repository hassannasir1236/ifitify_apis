<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'imageUrl'
    ];

    public function goalLevel(): HasMany
    {
        return $this->hasMany(GoalLevel::class);
    }
    public function getImageUrlAttribute(): ?string
    {
        return $this->images ? asset('training_level_images/' . $this->images) : null;
    }
    public function goals()
    {
        return $this->hasManyThrough(
            Goal::class,
            GoalLevel::class,
            'training_level_id',  // Foreign key on goal_levels table
            'id',                  // Foreign key on goals table
            'id',                  // Local key on training_levels table
            'goal_id'               // Local key on goal_levels table
        );
    }
}
