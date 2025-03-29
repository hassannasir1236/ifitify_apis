<?php

namespace App\Repositories;

use App\Models\Goal;
use Illuminate\Database\Eloquent\Collection;

class GoalRepository
{
    public function get(): Collection
    {
        // return Goal::orderBy('created_at', 'desc')->get();
        return Goal::with(['userLevels', 'trainingLevels'])->get();
    }
    public function create(array $data): Goal
    {
        return Goal::create($data);
    }

    public function update(Goal $Goal, array $data): bool
    {
        return Goal::find($Goal->id)->update($data);
    }
    public function getGoalById(int $id): Goal
    {
        return Goal::find($id);
    }
}
