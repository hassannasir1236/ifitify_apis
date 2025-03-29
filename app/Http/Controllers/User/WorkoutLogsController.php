<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\UserIntervalWorkout;
use App\Models\CompletedQuickWorkout;
use App\Models\UserWorkoutLog;
use App\Models\UserExercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutLogsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'workout_id' => 'required',
            'set' => 'required|integer|min:1',
            'reps' => 'required|integer|min:1',
            'rest_time' => 'nullable|integer|min:0',
            'kg' => 'required|numeric|min:0',
            'is_completed' => 'required|boolean',
            'comment' => 'nullable|string',
            'workout_log_title' => 'required|string',
        ]);

        $workoutLog = UserWorkoutLog::create([
            'exercise_id' => $request->exercise_id,
            'user_id' => auth()->user()->id,
            'set' => $request->set,
            'reps' => $request->reps,
            'kg' => $request->kg,
            'is_completed' => $request->is_completed,
            'rest_time' => $request->rest_time,
            'workout_log_title' => $request->workout_log_title,
            'workout_id' => $request->workout_id,
        ]);

        return response()->json($workoutLog, 201);
    }

    public function getUserWorkouts()
    {
        $user = Auth::user();

        $workouts = Exercise::with(['workoutLogs' => function ($query) use ($user) {
            $query->where('user_id', $user->id)->orderBy('created_at', 'desc');
        }])
            ->whereHas('workoutLogs', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get()
            ->map(function ($exercise) {
                $latestLog = $exercise->workoutLogs->first();
                return [
                    'workout_log_title' => $latestLog ? $latestLog->workout_log_title : null,
                    'comments' => $latestLog ? (!is_null($latestLog->comment) ? $latestLog->comment : '') : " ",
                    'logs' => $exercise->workoutLogs->map(function ($log) {
                        return [
                            'id' => $log->id,
                            'sets' => $log->set,
                            'reps' => $log->reps,
                            'kg' => $log->kg,
                            'is_completed' => $log->is_completed
                        ];
                    })
                ];
            });

        return response()->json($workouts);
    }

    public function getWorkoutLog($workout_id)
    {
        $user = Auth::user();

        // Get the base workout details
        $workoutCollection = $this->findWorkout($workout_id, $user->id);

        if ($workoutCollection->isEmpty()) {
            return $this->getDefaultResponse($workout_id);
        }

        // Get all exercise IDs from this workout
        $exerciseIds = $workoutCollection->pluck('exercise.id')->toArray();

        // Get any existing workout logs for these exercises
        $workoutLogs = $this->getExistingWorkoutLogs($workout_id,$exerciseIds, $user->id);

        return $this->processWorkout($workoutCollection, $workoutLogs, $workout_id);
    }

    private function getExistingWorkoutLogs($workout_id, $exerciseIds, $user_id)
    {
        return UserWorkoutLog::whereIn('exercise_id', $exerciseIds)
            ->where('user_id', $user_id)
            ->where('workout_id', $workout_id)
            ->get();
    }

    private function processWorkout($workoutCollection, $workoutLogs, $workout_id)
    {
        $firstWorkout = $workoutCollection->first();
        $logsByExercise = $workoutLogs->groupBy('exercise_id');

        $exercises = $workoutCollection->map(function ($workout) use ($logsByExercise) {

            $exerciseId = $workout->exercise->id;
            $logs = $logsByExercise->get($exerciseId, collect());

            return [
                'id' => $exerciseId,
                'name' => $workout->exercise->name,
                'image' => $this->getImageUrl($workout->exercise->image_url),
                'sets' => $this->mapSets($logs),
            ];
        });

        $workoutTitle = $workoutLogs->isNotEmpty()
            ? $workoutLogs->first()->workout_log_title
            : $this->determineWorkoutTitle($firstWorkout);

        return response()->json([
            'workout_id' => $workout_id,
            'workout_title' => $workoutTitle,
            'workout_image' => $firstWorkout->image ?? $this->getImageUrl($firstWorkout->exercise->image_url),
            'duration' => $this->getDuration($workout_id),
            'rest_between_events' => $firstWorkout->rest_between_events ?? 10,
            'preparation_duration' => $firstWorkout->preparation_duration ?? 10,
            'exercises' => $exercises,
        ]);
    }

    private function findWorkout($workout_id, $user_id)
    {
        $regularWorkout = UserExercise::with(['exercise'])
            ->where('custom_workout_id', $workout_id)
            ->where('user_id', $user_id)
            ->get();

        if (!$regularWorkout->isEmpty()) {

            return $regularWorkout;
        }

        return UserIntervalWorkout::with(['video.exercise'])
            ->where('interval_workout_id', $workout_id)
            ->where('user_id', $user_id)
            ->get();
    }

    private function determineWorkoutTitle($workout)
    {
        if ($workout instanceof UserExercise) {
            return $workout->name ?? "Custom workout";
        }

        if ($workout instanceof UserIntervalWorkout) {
            return $workout->interval_workout_name ?? "Custom workout";
        }

        return "Custom workout";
    }

    private function getDefaultResponse($workout_id)
    {
        return response()->json([
            'workout_id' => $workout_id,
            'workout_title' => "Custom workout",
            'workout_image' => "",
            'duration' => 0,
            'exercises' => []
        ]);
    }

    private function mapSets($logs)
    {
        return $logs->map(function ($log) {
            return [
                'id' => $log->id,
                'set' => $log->set,
                'reps' => $log->reps,
                'kg' => $log->kg,
                'rest_time' => $log->rest_time,
                'is_completed' => $log->is_completed,
                'comment' => $log->comment,
            ];
        })->values()->toArray();
    }

    private function getImageUrl($path)
    {
        return $path ? config('app.url') . '/' . $path : null;
    }
    public function updateWorkoutLog(Request $request, $id)
    {
        $user = Auth::user();

        $workoutLog = UserWorkoutLog::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$workoutLog) {
            return response()->json([], 200);
        }

        $request->validate([
            'exercise_id' => 'sometimes|exists:exercises,id',
            'set' => 'sometimes|integer|min:1',
            'reps' => 'sometimes|integer|min:1',
            'rest_time' => 'sometimes|nullable|integer|min:0',
            'kg' => 'sometimes|numeric|min:0',
            'is_completed' => 'sometimes|boolean',
            'comment' => 'sometimes|nullable|string',
            'workout_log_title' => 'sometimes|string',
        ]);

        $workoutLog->update($request->only([
            'exercise_id',
            'set',
            'reps',
            'kg',
            'rest_time',
            'is_completed',
            'comment',
            'workout_log_title'
        ]));

        return response()->json($workoutLog);
    }

    public function completeWorkout(Request $request)
    {
        $validated = $request->validate([
            'is_completed' => 'required|boolean',
            'duration' => 'required',
            'workout_id' => 'required',
            'batch_id' => 'nullable',
            'key' => 'required|in:custom_workout,interval_workout,quick_workout'
        ]);

        $user = Auth::user();

        $workoutTypes = [
            'custom_workout' => [
                'model' => UserExercise::class,
                'workout_id_column' => 'custom_workout_id',
                'duration_column' => 'duration'
            ],
            'interval_workout' => [
                'model' => UserIntervalWorkout::class,
                'workout_id_column' => 'interval_workout_id',
                'duration_column' => 'full_screen_duration'
            ],
            'quick_workout' => [
                'model' => CompletedQuickWorkout::class,
                'workout_id_column' => 'workout_id',
                'batch_id' => 'batch_id'
            ]
        ];

        $workoutType = $workoutTypes[$validated['key']];

        try {
            if($validated['key'] == 'quick_workout'){
                if (empty($validated['batch_id'])) {
                    return response()->json(['message' => 'Workout batch id missing.'], 404);
                }
                $existingRecord = CompletedQuickWorkout::where('user_id', $user->id)
                    ->where('workout_id', $validated['workout_id'])
                    ->where('batch_id', $validated['batch_id'])
                    ->first();  

                if (!empty($existingRecord)) {
                    $updated = $existingRecord->update([
                        'is_completed' => $validated['is_completed'],
                    ]);
                } else {
                    $updated = CompletedQuickWorkout::create([
                        'user_id' => $user->id,
                        'workout_id' => $validated['workout_id'],
                        'batch_id' => $validated['batch_id'] ?? null, 
                        'is_completed' => filter_var($validated['is_completed'], FILTER_VALIDATE_BOOLEAN), 
                    ]);
                } 
            }else{
                $updated = $workoutType['model']::where($workoutType['workout_id_column'], $validated['workout_id'])
                    ->where('user_id', $user->id)
                    ->update([
                        'is_completed' => $validated['is_completed'],
                        $workoutType['duration_column'] => $validated['duration']
                ]); 
            }

            if (!$updated) {
                return response()->json(['message' => 'Workout not found'], 404);
            }

            return response()->json(['message' => 'Workout completed successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Workout completion failed: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to complete workout'], 500);
        }
    }

    public function updateDuration(Request $request)
    {
        $validated = $request->validate([
            'duration' => 'required|integer',
            'workout_id' => 'required',
            'key' => 'required|in:custom_workout,interval_workout'
        ]);

        $user = Auth::user();

        $workoutTypes = [
            'custom_workout' => [
                'model' => UserExercise::class,
                'workout_id_column' => 'custom_workout_id',
                'duration_column' => 'duration'
            ],
            'interval_workout' => [
                'model' => UserIntervalWorkout::class,
                'workout_id_column' => 'interval_workout_id',
                'duration_column' => 'full_screen_duration'
            ]
        ];

        $workoutType = $workoutTypes[$validated['key']];

        try {
            $updated = $workoutType['model']::where($workoutType['workout_id_column'], $validated['workout_id'])
                ->where('user_id', $user->id)
                ->update([
                    $workoutType['duration_column'] => $validated['duration']
                ]);

            if (!$updated) {
                return response()->json(['message' => 'Workout not found'], 404);
            }

            return response()->json([
                'message' => 'Duration updated successfully',
                'duration' => $validated['duration']
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Workout duration update failed: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update workout duration'], 500);
        }
    }

    private function getDuration($workout_id)
    {
        $workout = UserExercise::where('custom_workout_id', $workout_id)->first();

        if ($workout) {
            return $workout->duration ?? 0;
        }

        $intervalWorkout = UserIntervalWorkout::where('interval_workout_id', $workout_id)->first();
        return $intervalWorkout ? $intervalWorkout->full_screen_duration : 0;
    }
}
