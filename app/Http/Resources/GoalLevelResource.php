<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoalLevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->trainingLevel->id,
            'title' => $this->trainingLevel->title,
            'description' =>  $this->trainingLevel->description,
//            'icon' => $this->trainingLevel->icon,
        ];
    }
}
