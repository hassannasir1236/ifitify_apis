<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\UserExercise;
use App\Models\UserIntervalWorkout;
use Illuminate\Http\Request;

class UploadWorkoutImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'workout_id' => 'required|string'
        ]);

        $workout = $this->getWorkout($request->workout_id);
        $image = $request->file('image');
        $name = uniqid() . auth()->user()->id . "." . $image->guessExtension();
        $destinationPath = public_path('workoutImages');

        $data = ['image' => config('app.url') . '/' .'workoutImages/' . $name];

        foreach ($workout as $_workout) {

            $_workout->update($data);
        }
        $image->move($destinationPath, $name);

        return response()->json('image updated', 200);
    }

    private function getWorkout($workout_id)
    {
        $userExercises = UserExercise::where('custom_workout_id', $workout_id)->get();

        if ($userExercises->isNotEmpty()) {
            return $userExercises;
        }

        return UserIntervalWorkout::where('interval_workout_id', $workout_id)->get();
    }
}
