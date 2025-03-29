<?php

namespace App\Repositories;

use App\Models\ExerciseEquipment;
use Illuminate\Database\Eloquent\Collection;

class ExerciseEquipmentRepository
{
    public function get(): Collection
    {
        return ExerciseEquipment::get();
    }
    public function create(array $data): ExerciseEquipment
    {
        return ExerciseEquipment::create($data);
    }

    public function getEquipmentByName(string $name): ExerciseEquipment | null
    {
        return ExerciseEquipment::where("name", $name)->first();
    }
}
