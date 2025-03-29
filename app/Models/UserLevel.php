<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'is_enabled',
        'description'
    ];

    public function goalUserLevel(): HasMany
    {
        return $this->hasMany(GoalUserLevel::class);
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

}
