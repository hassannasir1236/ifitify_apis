<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIntervalWorkoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->video->video_url,
            'interval_workout_name' => $this->interval_workout_name,
            'interval_workout_id' => $this->interval_workout_id,
            'full_screen_duration' => $this->full_screen_duration,
            'preparation_duration' => $this->preparation_duration,
            'rest_between_events' => $this->rest_between_events,
            'number_of_exercises' => $this->number_of_exercises,
            'number_of_sets' => $this->number_of_sets
        ];
    }
}
