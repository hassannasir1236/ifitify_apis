<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuickWorkoutResource extends JsonResource
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
            'video_url' => $this->video->video_url,
            'gif_url' => $this->name,
             'custom_name' => $this->name,
             'custom_workout_id' => $this->custom_workout_id
        ];
    }
}
