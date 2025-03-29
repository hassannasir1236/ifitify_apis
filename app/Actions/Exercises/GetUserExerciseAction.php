<?php

namespace App\Actions\Exercises;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class GetUserExerciseAction
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function execute(): Collection
    {
        return $this->userRepository->getExerciseVideos();
    }
}
