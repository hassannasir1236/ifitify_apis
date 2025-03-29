<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserIntervalWorkoutCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $groupedVideos = $this->collection->reduce(function ($carry, $intervalExercise) {
            $groupId = $intervalExercise->interval_workout_id;

            if (!isset($carry[$groupId])) {
                $carry[$groupId] = $this->initializeGroup($intervalExercise);
            }

            $carry[$groupId]['videos'][] = $this->formatVideo($intervalExercise);
            $carry[$groupId]['videosCount'] = count($carry[$groupId]['videos']);

            $this->updateVideoNames($carry[$groupId]['videos']);

            return $carry;
        }, []);

        return array_values(array_reverse($groupedVideos));
    }

    /**
     * Initialize a new group for an interval exercise.
     *
     * @param mixed $intervalExercise
     * @return array
     */
    private function initializeGroup($intervalExercise): array
    {

        return [
            'id' => $intervalExercise->interval_workout_id,
            'name' => $intervalExercise->interval_workout_name ?? '',
            'createdAt' => $intervalExercise->created_at->timestamp,
            'workout_image' => $intervalExercise->image ?? config('app.url') . '/' . $intervalExercise->video->image_url,
            'workout_duration' => $intervalExercise->full_screen_duration ?? 1200,
            'preparation_duration' => $intervalExercise->preparation_duration,
            'rest_between_sets' => $intervalExercise->rest_between_sets,
            'rest_between_exercises' => $intervalExercise->rest_between_exercises,
            'videosCount' => 0,
            'videos' => [],
        ];
    }

    /**
     * Format video data for an interval exercise.
     *
     * @param mixed $intervalExercise
     * @return array
     */
    private function formatVideo($intervalExercise): array
    {
        $url = $intervalExercise->interval_workout_type == 'QUICK_WORKOUT'
            ? $intervalExercise->quickWorkout->video_url
            : $intervalExercise->video->video_url;
        $instructions = $intervalExercise->interval_workout_type == 'QUICK_WORKOUT'
            ? ''
            : $intervalExercise->video->instructions;

        return [
            'id' => $intervalExercise->id,
            'playListName' => $intervalExercise->interval_workout_name ?? '',
            'url' => $url,
            'instructions' => $instructions,
        ];
    }

    /**
     * Update video names with their position in the list.
     *
     * @param array $videos
     */
    private function updateVideoNames(array &$videos): void
    {
        foreach ($videos as $key => &$video) {
            $video['intervalWorkoutName'] = "{$video['playListName']} video " . ($key + 1);
        }
    }
}
