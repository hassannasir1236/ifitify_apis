<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CombinedWorkoutsCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        $groupedWorkouts = $this->collection->groupBy(function ($item) {
            return $item instanceof \App\Models\QuickWorkout ? $item->uniqueId : $item->interval_workout_id;
        });

        return $groupedWorkouts->map(function ($group) {
            $firstItem = $group->first();
            if ($firstItem instanceof \App\Models\QuickWorkout) {
                return $this->formatQuickWorkout($group);
            } else {
                return $this->formatIntervalWorkout($group);
            }
        })->values()->toArray();
    }

    private function formatQuickWorkout(Collection $workouts): array
    {
        $firstWorkout = $workouts->first();
        return [
            'id' => $firstWorkout->uniqueId,
            'name' => $firstWorkout->name ?? '',
            'workout_duration' => $firstWorkout->workout_duration,
            'exercises_duration' => $firstWorkout->exercises_duration,
            'preparation_duration' => $firstWorkout->preparation_duration,
            'rest_between_exercises' => $firstWorkout->rest_between_exercises,
            'workout_image' => $firstWorkout->gif_url,
            'rest_between_sets' => $firstWorkout->rest_between_sets,
            'set' => $firstWorkout->set,
            'createdAt' => $firstWorkout->updated_at->timestamp,
            'videosCount' => $workouts->count(),
            'videos' => $workouts->map(function ($item) {
                return [
                    'id' => $item->id,
                    'playListName' => $item->name . ' video',
                    'video_url' => $item->video_url,
                    'gif_url' => $item->gif_url,
                    'set' => $item->set,
                    'duration' => $item->exercises_duration,
                ];
            })->values()->toArray(),
        ];
    }

    private function formatIntervalWorkout(Collection $workouts): array
    {
        $firstWorkout = $workouts->first();
        return [
            'id' => $firstWorkout->interval_workout_id,
            'name' => $firstWorkout->interval_workout_name ?? '',
            'set' => $firstWorkout->number_of_sets,
            'workout_duration' => $firstWorkout->full_screen_duration,
            'workout_image' => $firstWorkout->image ?? config('app.url') . '/' . $firstWorkout->video->image_url,
            'preparation_duration' => $firstWorkout->preparation_duration,
            'rest_between_sets' => $firstWorkout->rest_between_sets == 0 ? 10 : $firstWorkout->rest_between_sets,
            'exercises_duration' => $firstWorkout->exercises_duration == 0 ? 30 : $firstWorkout->exercises_duration,
            'rest_between_exercises' => $firstWorkout->rest_between_exercises == 0 ? 10 : $firstWorkout->rest_between_exercises,
            'createdAt' => $firstWorkout->updated_at->timestamp,
            'videosCount' => $workouts->count(),
            'videos' => $workouts->map(function ($item) {
                return [
                    'id' => $item->id,
                    'playListName' => $item->interval_workout_name,
                    'url' => $item->video->video_url,
                    'instructions' => $item->video->instructions,
                    'intervalWorkoutName' => $item->interval_workout_name . ' video',
                ];
            })->values()->toArray(),
        ];
    }
}
