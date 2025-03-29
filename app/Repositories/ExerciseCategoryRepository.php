<?php

namespace App\Repositories;

use App\Models\ExerciseCategory;
use Illuminate\Database\Eloquent\Collection;

class ExerciseCategoryRepository
{
    public function get(): Collection
    {
        return ExerciseCategory::get();
    }
    public function create(array $data): ExerciseCategory
    {
        return ExerciseCategory::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return ExerciseCategory::find($id)->update($data);
    }
    public function getExerciseCategoryById(int $id): ExerciseCategory | null
    {
        return ExerciseCategory::find($id);
    }
    public function getExerciseCategoryByName(string $title): ExerciseCategory | null
    {
        return ExerciseCategory::where("title", $title)->first();
    }
}
