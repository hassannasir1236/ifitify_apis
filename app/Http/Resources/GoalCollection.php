<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GoalCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
    // }
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($goal) {
            return [
                'id' => $goal->id,
                'title' => $goal->title,
                'description' => $goal->description,
                'icon' => url($goal->icon),
                'is_enabled' => (bool) $goal->is_enabled,
                'userLevels' => $goal->goal_userLevels->map(function ($userLevel) {
                    return [
                        'id' => $userLevel->id,
                        'title' => $userLevel->title,
                        'is_enabled' => (bool) $userLevel->is_enabled,
                    ];
                }),
                'trainingLevels' => $goal->goal_trainingLevels->map(function ($trainingLevel) {
                    return [
                        'id' => $trainingLevel->id,
                        'title' => $trainingLevel->title,
                        'description' => $trainingLevel->description,
                    ];
                }),
            ];
        })->toArray();
    }
}
