<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\started_interval_workout;
use App\Models\UserIntervalWorkout;
use Illuminate\Support\Facades\Auth;
class WorkoutController extends Controller
{
    public function storeOrUpdateStartedIntervalWorkout(Request $request)
    {
        $request->validate([
            'workout_id' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $workoutId = $request->input('workout_id');
        $userId = auth()->user()->id; 

        $workout = started_interval_workout::where('workout_id', $workoutId)
                                           ->where('user_id', $userId)
                                           ->first();

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $relativeImagePath = 'exercises/started_interval_exercise/images/';
        //     $destinationImagePath = public_path($relativeImagePath);

        //     if (!file_exists($destinationImagePath)) {
        //         mkdir($destinationImagePath, 0755, true);
        //     }

        //     $imageName = str_replace(' ', '_', $image->getClientOriginalName());
        //     $image->move($destinationImagePath, $imageName);
        //     $imagePath = $relativeImagePath . $imageName;
        // }
        if ($workout) {
            // $workout->update(['image' => $imagePath]);
            return response()->json(['message' => 'Workout Created successfully.']);
        } else {
            started_interval_workout::create([
                'workout_id' => $workoutId,
                'user_id' => $userId,
                'image' => null,
                'type' => null,
                'is_completed' => false
            ]);
            return response()->json(['message' => 'Workout Created successfully.']);
        }
    }
    // interval workout image upload 
    public function intervalWorkoutImageUpload(Request $request)
    {
        $request->validate([
            'workout_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'key' => 'required|in:user_interval_workout,interval_workout'
        ]);
        
        $user = Auth::user();

        $workoutModel = null;
        
        if ($request->key === 'interval_workout') {
            $workoutModel = started_interval_workout::where('workout_id', $request->workout_id)
                                                ->where('user_id', $user->id)
                                                ->first();
        } elseif ($request->key === 'user_interval_workout') {
            $workoutModel = UserIntervalWorkout::where('workout_id', $request->workout_id)
                                            ->where('user_id', $user->id)
                                            ->first();
        }

        if (!$workoutModel) {
            return response()->json([
                'success' => false,
                'message' => 'Workout record not found.'
            ], 404);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $relativeImagePath = 'exercises/started_interval_exercise/images/';
            $destinationImagePath = public_path($relativeImagePath);

            if (!file_exists($destinationImagePath)) {
                mkdir($destinationImagePath, 0755, true);
            }

            $imageName = str_replace(' ', '_', $image->getClientOriginalName());
            $image->move($destinationImagePath, $imageName);
            $imagePath = $relativeImagePath . $imageName;
        }
        $workoutModel->image = $imagePath;
        $workoutModel->save();

        return response()->json([
            'success' => true,
            'message' => 'Image uploaded and updated successfully.'
            // 'image_path' => $imagePath
        ]);
    }
    public function intervalWorkoutComplete(Request $request)
    {
        $request->validate([
            'workout_id' => 'required',
            'is_completed' => 'required|boolean',
            'key' => 'required|in:user_interval_workout,interval_workout'
        ]);
        
        $user = Auth::user();

        $workoutModel = null;
        
        if ($request->key === 'interval_workout') {
            $workoutModel = started_interval_workout::where('workout_id', $request->workout_id)
                                                ->where('user_id', $user->id)
                                                ->first();
        } elseif ($request->key === 'user_interval_workout') {
            $workoutModel = UserIntervalWorkout::where('workout_id', $request->workout_id)
                                            ->where('user_id', $user->id)
                                            ->first();
        }

        if (!$workoutModel) {
            return response()->json([
                'success' => false,
                'message' => 'Workout record not found.'
            ], 404);
        }

        $workoutModel->is_completed = $request->is_completed;
        $workoutModel->save();

        return response()->json([
            'success' => true,
            'message' => 'Completed Status is update.'
        ]);
    }

}

