<?php

namespace App\Repositories;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Collection;

class ExerciseRepository
{
    public function get(): Collection
    {
        return Exercise::get();
    }
    public function create(array $data): Exercise
    {
        return Exercise::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return Exercise::find($id)->update($data);
    }
    public function getExerciseById(int $id): Exercise | null
    {
        return Exercise::find($id);
    }
    public function getExerciseByName(string $name): Exercise | null
    {
        return Exercise::where("name", $name)->first();
    }
}
