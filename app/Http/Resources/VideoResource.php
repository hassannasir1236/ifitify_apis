<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'name' => $this->exercise->name,
            'category' => $this->exerciseCategory->title,
            'url' => $this->video_url,
            'image' => $this->image_url,
            'instruction' => $this->instructions
        ];
    }
}
