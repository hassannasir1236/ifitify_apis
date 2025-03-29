<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\GetQuickWorkoutsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CombinedWorkoutsCollection;
use App\Models\QuickWorkout;
use App\Models\UserIntervalWorkout;
use App\Models\CompletedQuickWorkout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Exercise; 
use Illuminate\Support\Facades\Auth;

class FitInMinutesWorkoutsController extends Controller
{
    public function getCombinedWorkouts(Request $request, GetQuickWorkoutsAction $levelAction,)
    {
        $user = $request->user();
        $level = $request->route('level');

        if (is_null($level)) {
            $userIntervalWorkouts = UserIntervalWorkout::where('user_id', $user->id)->where('interval_workout_type', 'INTERVAL_WORKOUT')->get();

            return new CombinedWorkoutsCollection($userIntervalWorkouts);
        }
        $validLevels = ['beginner', 'intermediate', 'advanced'];
        $level = Str::lower($level);

        // Check if the provided level is valid
        if (!in_array($level, $validLevels)) {
            // If not valid, find the closest match
            $closestMatch = $this->findClosestMatch($level, $validLevels);

            if ($closestMatch) {
                // If a close match is found, use it and return a 200 response with a warning
                $quickWorkouts = $levelAction->execute($closestMatch);
                $userIntervalWorkouts = UserIntervalWorkout::where('user_id', $user->id)
                    ->where('interval_workout_type', 'INTERVAL_WORKOUT')->get();

                $combinedWorkouts = $quickWorkouts->concat($userIntervalWorkouts);

                return new CombinedWorkoutsCollection($combinedWorkouts);
            } else {
                // If no close match, return a 400 Bad Request
                return response()->json([
                    'error' => "Invalid level provided. Valid levels are: " . implode(', ', $validLevels)
                ], 400);
            }
        }
        $quickWorkouts = $levelAction->execute($level);

        $userIntervalWorkouts = UserIntervalWorkout::where('user_id', $user->id)
            ->where('interval_workout_type', 'INTERVAL_WORKOUT')->get();

        $combinedWorkouts = $quickWorkouts->concat($userIntervalWorkouts);

        return new CombinedWorkoutsCollection($combinedWorkouts);
    }
    // custom code to get exercise
    public function getExerciseByLevelAndBatch(Request $request, $level = null)
    {
        
        $user = Auth::user();
        if (empty($level)) {
            return response()->json(['data' => array()]);
        }
        $level = strtolower(trim($level));
        switch ($level) {
            case 'beginner':
                $level_value = 1;
                break;
            case 'intermediate':
                $level_value = 2;
                break;
            case 'advanced':
                $level_value = 3;
                break;
            default:
                return response()->json(['error' => 'Invalid level id.'], 400);
        }

        $batch_id = $request->get('batch_id');

        // if (!$batch_id) {
        //     return response()->json(['error' => 'Batch ID is required.'], 400);
        // }

        $get_quick_workouts = QuickWorkout::where('level', $level)->get();
        if ($get_quick_workouts->isEmpty()) {
            return response()->json(['message' => 'No quick workouts found for this level.'], 404);
        }
        
        $basePath = url('/');
        $response = [];
        
        foreach ($get_quick_workouts as $get_quick_workout) {
            // Calculate the exercise limit per set
            $exercise_limit_set = $get_quick_workout->set * $get_quick_workout->exercise_each_set;
        
            // Fetch exercises with the specified conditions
            $get_exercises = Exercise::where('type', 'fit_in_min')
                ->where('user_level', $level_value)
                ->orderBy('belong_to_set', 'asc')
                ->limit($exercise_limit_set)
                ->get();
        
            // Group exercises by batch_id
            $exercises_by_batch = $get_exercises->groupBy('batch_id')->sortKeysDesc();
        
            foreach ($exercises_by_batch as $batch_id => $exercises) {
                $videos = [];
                $isCompleted = false;
        
                foreach ($exercises as $exercise) {
                    // Fetch completed workout details for this batch
                    $get_completed_workout = CompletedQuickWorkout::where('user_id', $user->id)
                        ->where('batch_id', $batch_id)
                        ->where('workout_id', $get_quick_workout->id)
                        ->first();
        
                    if ($get_completed_workout && $get_completed_workout->is_completed == 1) {
                        $isCompleted = true;
                    }
        
                    $videos[] = [
                        'id' => $exercise->id,
                        'playListName' => $exercise->name,
                        'video_url' => ($exercise->video_url) ? $basePath . '/' . $exercise->video_url : null,
                        'gif_url' => ($exercise->image_url) ? $basePath . '/' . $exercise->image_url : null,
                        'set' => $exercise->belong_to_set,
                        'duration' => $get_quick_workout->exercises_duration,
                    ];
                }
        
                // Add batch-wise data to the response
                $response[] = [
                    'id' => (string) $get_quick_workout->id,
                    'batch_id' => $batch_id,
                    'name' => $get_quick_workout->name,
                    'workout_duration' => $get_quick_workout->workout_duration,
                    'exercises_duration' => $get_quick_workout->exercises_duration,
                    'preparation_duration' => $get_quick_workout->preparation_duration,
                    'rest_between_exercises' => $get_quick_workout->rest_between_exercises,
                    'workout_image' => ($get_quick_workout->gif_url) ? $get_quick_workout->gif_url : null,
                    'rest_between_sets' => $get_quick_workout->rest_between_sets,
                    'set' => $get_quick_workout->set,
                    'isCompleted' => $isCompleted,
                    'createdAt' => $get_quick_workout->created_at->timestamp,
                    'videosCount' => count($videos),
                    'videos' => $videos,
                ];
            }
        }
        
        return response()->json(['data' => $response]);
    }
    

    /**
     * Find the closest matching string in an array.
     */
    private function findClosestMatch(string $input, array $possibilities): ?string
    {
        $closest = null;
        $closestDistance = PHP_INT_MAX;

        foreach ($possibilities as $possibility) {
            $distance = levenshtein($input, $possibility);
            if ($distance < $closestDistance) {
                $closest = $possibility;
                $closestDistance = $distance;
            }
        }

        // Only return a match if it's reasonably close (e.g., distance <= 3)
        return $closestDistance <= 3 ? $closest : null;
    }
}
