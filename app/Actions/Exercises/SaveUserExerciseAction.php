<?php

namespace App\Actions\Exercises;

use App\Repositories\UserRepository;

class SaveUserExerciseAction
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function execute(array $videos, string $name = null): bool
    {
        return $this->userRepository->saveExerciseVideos($videos, $name);
    }
}
