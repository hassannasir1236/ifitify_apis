<?php

namespace App\Actions\Exercises;

use App\Models\ExerciseEquipment;
use App\Repositories\ExerciseEquipmentRepository;

class CreateExerciseEquipmentAction
{
    public function __construct(
        private readonly ExerciseEquipmentRepository $exerciseEquipmentRepository
    ) {
    }

    public function execute(array $data): ExerciseEquipment
    {
        $equipment = $this->exerciseEquipmentRepository->getEquipmentByName($data['name']);
        
        if(is_null($equipment)){
            return $this->exerciseEquipmentRepository->create($data);
        }

        return $equipment;
    }
}
