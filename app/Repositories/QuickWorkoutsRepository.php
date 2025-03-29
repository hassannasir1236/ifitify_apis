<?php

namespace App\Repositories;

use App\Models\QuickWorkout;
use App\Models\UserIntervalWorkout;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class QuickWorkoutsRepository
{
    private const WORKOUT_LEVELS = [
        'beginner' => 25,
        'intermediate' => 30,
        'advanced' => 36
    ];

    public function getWorkoutByLevel(string $level): Collection
    {
        if (!array_key_exists($level, self::WORKOUT_LEVELS)) {
            throw new \InvalidArgumentException("Invalid workout level: $level");
        }

        $workouts = QuickWorkout::where('level', $level)
            ->limit(self::WORKOUT_LEVELS[$level])
            ->get();

        $uniqueId = $this->createFitInMinIntervalWorkout($workouts);

        return $workouts->map(function ($workout) use ($uniqueId) {
            $workout->uniqueId = $uniqueId;
            return $workout;
        });
    }

    public function getBeginnerWorkout(): Collection
    {
        return $this->getWorkoutByLevel('beginner');
    }

    public function getIntermediateWorkout(): Collection
    {
        return $this->getWorkoutByLevel('intermediate');
    }

    public function getAdvancedWorkout(): Collection
    {
        return $this->getWorkoutByLevel('advanced');
    }

    public function create(array $data): Video
    {
        return QuickWorkout::create($data);
    }

    private function createFitInMinIntervalWorkout(Collection $quickWorkouts): string
    {
        $uniqueId = Str::uuid();
        $userId = auth()->id();

        $workoutsData = $quickWorkouts->map(function ($quickWorkout) use ($uniqueId, $userId, $quickWorkouts) {
            return [
                'user_id' => $userId,
                'video_id' => $quickWorkout->id,
                'interval_workout_id' => $uniqueId,
                'interval_workout_name' => $quickWorkout->level . '-fit-in-minutes',
                'full_screen_duration' => $quickWorkout->workout_duration,
                'preparation_duration' => $quickWorkout->preparation_duration,
                'rest_between_sets' => $quickWorkout->rest_between_sets,
                'number_of_exercises' => $quickWorkouts->count(),
                'number_of_sets' => $quickWorkout->set,
                'image' => $quickWorkout->gif_url,
                'rest_between_exercises' => $quickWorkout->rest_between_exercises,
                'exercises_duration' => $quickWorkout->exercises_duration,
                'interval_workout_type' => 'QUICK_WORKOUT',
                'created_at' => now(),
                'updated_at' => now()
            ];
        })->toArray();

        UserIntervalWorkout::insert($workoutsData);

        return $uniqueId;
    }
}
