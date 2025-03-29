<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserExercise;
use App\Models\Exercise;

class ReplaceUserExerciseController extends Controller
{
    public function replace_user_exercise_ids(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'workout_id' => 'required',
            'previous_exercise_id' => 'required|integer|exists:user_exercises,exercise_id',
            'new_exercise_id' => 'required|integer',
        ], [
            'workout_id.required' => 'The workout ID is required.',
            'previous_exercise_id.required' => 'The previous exercise ID is required.',
            'new_exercise_id.required' => 'The new exercise ID is required.',
            'new_exercise_id.distinct' => 'The new exercise ID must be different from the previous exercise ID.',
        ]);

        // Get the custom workout ID, previous exercise ID, and new exercise ID
        $customWorkoutId = $request->workout_id;
        $previousExerciseId = $request->previous_exercise_id;
        $newExerciseId = $request->new_exercise_id;

        // Check if the previous exercise exists
        $previousExercise = UserExercise::where('custom_workout_id', $customWorkoutId)
            ->where('exercise_id', $previousExerciseId)
            ->first();

        if (!$previousExercise) {
            return response()->json(['message' => 'Previous exercise ID not found.'], 404);
        }

        // Check if the new exercise ID exists for the same workout
        $newExercise = UserExercise::where('custom_workout_id', $customWorkoutId)
            ->where('exercise_id', $newExerciseId)
            ->first();

        if ($newExercise) {
            // If new exercise ID exists, update the previous exercise ID
            $previousExercise->exercise_id = $newExerciseId;
            $previousExercise->save();

            // Optionally, delete the record for the new exercise ID
            $newExercise->delete();

            return $this->getExercisesByWorkoutIds($customWorkoutId, $newExerciseId);
        } else {
            // If new exercise ID does not exist, just replace the previous exercise ID
            $previousExercise->exercise_id = $newExerciseId;
            $previousExercise->save();
            
            return $this->getExercisesByWorkoutIds($customWorkoutId, $newExerciseId);
           // return response()->json(['message' => 'Previous exercise ID replaced with new exercise ID.'], 200);
        }
    }
    private function getExercisesByWorkoutIds($workoutIds, $newExerciseId)
    {
        $exercises = UserExercise::whereIn('custom_workout_id', (array)$workoutIds)
            ->where('exercise_id', $newExerciseId)
            ->with('exercise') 
            ->get();

        $videos = new \stdClass();
        foreach ($exercises as $exercise) {
            $videos = array(
                'id' => $exercise->exercise->id,
                'name' => $exercise->exercise->name,
                'image' => url("{$exercise->exercise->image_url}"),
                'sets' => [],
            );
        }

        // Return response in desired object format
        return response()->json($videos, 200);
    }

    
}
