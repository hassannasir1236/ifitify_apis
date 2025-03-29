<?php

namespace App\Actions\Exercises;

use App\Models\Exercise;
use App\Repositories\ExerciseRepository;

class CreateExerciseAction
{
    public function __construct(
        private readonly ExerciseRepository $exerciseRepository
    ) {
    }

    public function execute(array $data): Exercise
    {
        $exercise = $this->exerciseRepository->getExerciseByName($data['name']);
        
        if(is_null($exercise)){
            return $this->exerciseRepository->create($data);
        }

        return $exercise;
    }
}
