<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserExercise;
use Illuminate\Support\Facades\DB;
use App\Models\UserWorkoutLog;
class ExerciseController extends Controller
{
    public function addExercises(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:user_exercises,custom_workout_id',
            'videos' => 'required|array', 
        ]);

        $workoutId = $request->input('id');
        $exerciseIds = $request->input('videos');
        $workout = UserExercise::where('custom_workout_id', $workoutId)->first(['user_id', 'name', 'duration', 'is_completed']);

        if (!$workout) {
            return response()->json(['message' => 'Workout details not found.'], 404);
        }

        $newExercises = [];

        foreach ($exerciseIds as $exerciseId) {
            $exists = UserExercise::where('custom_workout_id', $workoutId)
                ->where('exercise_id', $exerciseId)
                ->exists();

            if (!$exists) {
                $newExercises[] = [
                    'custom_workout_id' => $workoutId,
                    'exercise_id' => $exerciseId,
                    'user_id' => $workout->user_id, 
                    'name' => $workout->name, 
                    'duration' => $workout->duration, 
                    'is_completed' => $workout->is_completed, 
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        if (!empty($newExercises)) {
            UserExercise::insert($newExercises);
        }
       return $this->getExercisesByWorkoutIds($workoutId, $exerciseIds);
    }
    
    private function getExercisesByWorkoutIds($workoutId, $exerciseIds)
    {
        $exercises = UserExercise::where('custom_workout_id', $workoutId)
            ->whereIn('exercise_id', $exerciseIds)
            ->with('exercise')
            ->get();

        // Initialize $videos as an array
        $videos = [];
        foreach ($exercises as $exercise) {
            $videos[] = [
                'id' => $exercise->exercise_id,
                'name' => $exercise->exercise->name,
                'image' => url("{$exercise->exercise->image_url}"),
                'sets' => [],
            ];
        }

        return response()->json(['exercises' => $videos], 200);
    }
    // graph data content
    public function graphData(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'exercise_id' => 'required|integer|exists:exercises,id', // Ensure exercise_id is valid
        ]);
    
        $exerciseId = $validatedData['exercise_id'];
        $userId = auth()->id();
    
        // Fetch workout logs grouped by workout_id
        $workoutLogs = UserWorkoutLog::select(
                'workout_id',
                DB::raw('SUM(kg) as total_weight'),
                DB::raw('SUM(reps) as total_reps'),
                DB::raw('COUNT(workout_id) as total_workouts'),
                DB::raw('MIN(created_at) as start_date'),
                DB::raw('MAX(created_at) as end_date')
            )
            ->where('user_id', $userId)
            ->where('exercise_id', $exerciseId)
            ->groupBy('workout_id') // Grouping by workout_id
            ->get();
    
        // Check if records exist
        if ($workoutLogs->isEmpty()) {
            return response()->json(['message' => 'No workout records found.'], 404);
        }
    
        // Format the response
        $response = $workoutLogs->map(function ($log) {
            return [
                'workout_id' => $log->workout_id,
                'start_date' => strtotime($log->start_date),
                'end_date' => strtotime($log->end_date),
                'total_weight' => (int) $log->total_weight,
                'total_reps' => (int) $log->total_reps,
                'total_workouts' => (int) $log->total_workouts,
            ];
        });
    
        return response()->json(['data' => $response]);
    }    
    
    

}
