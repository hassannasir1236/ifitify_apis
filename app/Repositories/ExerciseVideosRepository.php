<?php

namespace App\Repositories;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Collection;

class ExerciseVideosRepository
{
    public function get(array $categories, array $equipments): Collection
    {
        $query = Exercise::query();
        // $query->where('goal_id', auth()->user()->goal_id)
        //     ->where('user_level', auth()->user()->user_level_id)
        //     ->where('type', 'general_exercise');
        $query->whereIn('goal_id', explode(',', auth()->user()->goal_id))
        ->whereIn('user_level', explode(',', auth()->user()->user_level_id))
            ->where('type', 'general_exercise');

        $query->whereIn('exercise_equipment_id', $equipments);

        if (!empty($categories)) {
            $query->whereIn('exercise_category_id', $categories);
        }

        return $query->get();
    }
    public function create(array $data): Exercise
    {
        return Exercise::create($data);
    }
}
