<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserExerciseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $groupedVideos = [];

        foreach ($this as $userExercise) {
            // print_r($userExercise);
            $groupId = $userExercise->custom_workout_id;
            // $id = $userExercise->id;
            $id = $userExercise->exercise->exercise_id ?? null;
            $playListName = $userExercise->name ?? '';
            $isCompleted = $userExercise->is_completed;
            $url = $userExercise->exercise->image ?? null;
            $instructions = $userExercise->exercise->instructions ?? null;
            $image = $userExercise->image 
            ?? ($userExercise->exercise ? config('app.url') . '/' . $userExercise->exercise->image_url : null);           
            $createdAt = $userExercise->created_at->timestamp;
            $workout_duration = $userExercise->duration ?? 1200;

            $groupedVideos[$groupId]['id'] = $groupId;
            $groupedVideos[$groupId]['name'] = $playListName;
            $groupedVideos[$groupId]['createdAt'] = $createdAt;
            $groupedVideos[$groupId]['videosCount'] = 0;
            $groupedVideos[$groupId]['isCompleted'] = $isCompleted;
            $groupedVideos[$groupId]['workout_image'] = $image;
            $groupedVideos[$groupId]['workout_duration'] = $workout_duration == 0 ? 10 : $workout_duration;
            $groupedVideos[$groupId]['preparation_duration'] = 10;
            $groupedVideos[$groupId]['rest_between_sets'] = 60;
            $groupedVideos[$groupId]['rest_between_exercises'] = 10;
            $groupedVideos[$groupId]['videos'][] = array(
                "id" => $id,
                "playListName" => $playListName,
                "url" => $url,
                "instructions" => $instructions
            );
            $groupedVideos[$groupId]['videosCount'] = count($groupedVideos[$groupId]['videos']);

            foreach ($groupedVideos[$groupId]['videos'] as $key => &$video) {
                $video['playListName'] =  $playListName . ' ' . 'video ' . $key + 1;
            }
        }
        return array_reverse(array_values($groupedVideos));
    }
}
