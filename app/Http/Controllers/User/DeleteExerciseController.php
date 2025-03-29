<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserExercise;

class DeleteExerciseController extends Controller
{
    public function detele_user_exercise(Request $request) {
      
        $request->validate([
            'id' => 'required|integer|exists:user_exercises,exercise_id',
            'workout_id' => 'required'
        ]);
        $id = $request->input('id');
        $workout_id = $request->input('workout_id');
        $exercise = UserExercise::where('exercise_id', $id)
                    ->where('custom_workout_id', $workout_id)
                    ->first();
        if ($exercise) {
            $exercise->delete();
            return response()->json(['message' => 'Exercise deleted successfully.'], 200);
        }
    
        return response()->json(['message' => 'Exercise not found.'], 404);
    }    
}
