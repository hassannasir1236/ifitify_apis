<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'title' => $this->title,
            'description' =>  $this->description,
            'icon' => config('app.url') . '/'.$this->icon,
            'userLevels' => new GoalUserLevelCollection($this->userLevels),
            'trainingLevels' => new GoalLevelCollection($this->trainingLevels),
        ];
    }
}
