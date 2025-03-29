<?php

namespace App\Actions\Exercises;

use App\Repositories\ExerciseEquipmentRepository;
use Illuminate\Database\Eloquent\Collection;

class GetExerciseEquipmentsAction
{
    public function __construct(
        private readonly ExerciseEquipmentRepository $equipmentRepository
    ) {
    }

    public function execute(): Collection
    {
        return $this->equipmentRepository->get();
    }
}
