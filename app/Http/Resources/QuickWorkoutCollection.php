<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuickWorkoutCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $groupedVideos = [];

        foreach ($this as $quickWorkout) {
            $groupId = $quickWorkout->custom_workout_id;
            $id = $quickWorkout->id;
            $playListName = $quickWorkout->name ?? '';
            $video_url = $quickWorkout->video_url;
            $gif_url = $quickWorkout->gif_url;
            $set = $quickWorkout->set;
            $duration = $quickWorkout->duration;
            $createdAt = $quickWorkout->updated_at->toDayDateTimeString();

            $groupedVideos[$groupId]['id'] = $groupId;
            $groupedVideos[$groupId]['name'] = $playListName;
            $groupedVideos[$groupId]['createdAt'] = $createdAt;
            $groupedVideos[$groupId]['videosCount'] = 0;
            $groupedVideos[$groupId]['videos'][] = array(
                "id" => $id,
                "playListVideoName" => $playListName,
                "video_url" =>  $video_url,
                "gif_url" =>  $gif_url,
                "set" => $set,
                "duration" => $duration,
            );
            $groupedVideos[$groupId]['videosCount'] = count( $groupedVideos[$groupId]['videos']);

            foreach ($groupedVideos[$groupId]['videos'] as $key => &$video){
                $video['playListVideoName'] =  $playListName.' '.'video '.$key+1;
            }
        }
        return array_reverse(array_values($groupedVideos));
    }
}
