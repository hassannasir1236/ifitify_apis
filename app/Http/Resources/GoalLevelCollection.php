<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GoalLevelCollection extends ResourceCollection
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
        return $this->collection->map(function ($goalLevel) {
            return [
                'id' => $goalLevel->trainingLevel->id ?? null,
                'title' => $goalLevel->trainingLevel->title ?? null,
                'description' => $goalLevel->trainingLevel->description ?? null,
                'imageUrl' => $goalLevel->trainingLevel->imageUrl 
                    ? asset($goalLevel->trainingLevel->imageUrl) 
                    : null,
            ];
        })->toArray();
    }
}
