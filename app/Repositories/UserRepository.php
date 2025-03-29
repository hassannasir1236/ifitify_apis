<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserRepository
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): bool
    {
        return User::find($user->id)->update($data);
    }
    public function getUserById(int $id): User
    {
        return User::find($id);
    }
    public function getUserByEmail(string $email): User | null
    {
        return User::where("email", $email)->first();
    }

    public function updateUserGoal(string $goalId): bool
    {
        return auth()->user()->update(['goal_id' => $goalId]);
    }

    public function saveExerciseVideos(array $videos, string $name = null): bool
    {
        $uniqueId = Str::uuid();
        foreach ($videos as $videoId) {
            auth()->user()->savedExercises()->create([
                // 'video_id' => $videoId,
                'exercise_id' => $videoId,
                'name' => $name,
                'custom_workout_id' =>  $uniqueId
            ]);
        }
        return true;
    }
    public function saveIntervalWorkoutDetails(Request $request): bool
    {
        $uniqueId = Str::uuid();

        foreach ($request->videos as $videoId) {
            auth()->user()->savedIntervalWorkouts()->create([
                'video_id' => $videoId,
                'interval_workout_name' => $request->interval_workout_name,
                'interval_workout_id' =>  $uniqueId,
                'full_screen_duration' => $request->full_screen_duration,
                'preparation_duration' => $request->preparation_duration,
                'rest_between_sets' => $request->rest_between_events,
                'number_of_exercises' => $request->number_of_exercises,
                'number_of_sets' => $request->number_of_sets,
                'rest_between_exercises' => $request->rest_between_exercises ?? $request->rest_between_events,
                'exercises_duration' => $request->exercises_duration ?? $request->full_screen_duration,
            ]);
        }
        return true;
    }

    public function getExerciseVideos(): Collection
    {
        return auth()->user()->savedExercises()->get();
    }
    public function getIntervalWorkoutVideos(): Collection
    {
        return auth()->user()->savedIntervalWorkouts()->get();
    }

    public function updateProgressImage(User $user, array $data): bool
    {
        $user->metrics()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );
        return true;
    }
}
