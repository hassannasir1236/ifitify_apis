<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country_code',
        'phone',
        'password',
        'gender',
        'start_weight',
        'start_weight_unit',
        'start_height',
        'start_height_unit',
        'age',
        'date_of_birth',
        'goal_id',
        'user_level_id',
        'email_verified_at',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'date_of_birth' => 'datetime'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the goal associated with the user.
     */
   // public function goal(): BelongsTo
    // {
    //     return $this->belongsTo(Goal::class);
    // }
    public function goals(): Collection
    {
        // Fetch the goal_ids from the column and convert to array
        $goalIds = explode(',', $this->goal_id);
    
        // Fetch all goals matching these IDs
        return Goal::whereIn('id', $goalIds)->get();
    }
    public function getGoals()
    {
        $goalIds = explode(',', $this->goal_ids); 
        return Goal::whereIn('id', $goalIds)->get();
    }
    public function userLevels()
    {
        $userLevelIds = explode(',', $this->user_level_id);
        return UserLevel::whereIn('id', $userLevelIds)->get();
    }


    /**
     * Get the user level associated with the user.
     */
    public function userLevel(): BelongsTo
    {
        return $this->belongsTo(UserLevel::class);
    }

    /**
     * Get the users saved exercises.
     */
    public function savedExercises(): HasMany
    {
        return $this->hasMany(UserExercise::class);
    }

    /**
     * Get the users saved interval workouts.
     */
    public function savedIntervalWorkouts(): HasMany
    {
        return $this->hasMany(UserIntervalWorkout::class);
    }

    /**
     * Get the user's metrics.
     */
    public function metrics(): HasOne
    {
        return $this->hasOne(UserMetric::class);
    }
}
