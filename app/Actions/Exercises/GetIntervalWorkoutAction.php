<?php


namespace App\Actions\Exercises;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class GetIntervalWorkoutAction
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function execute(): Collection
    {
        return $this->userRepository->getIntervalWorkoutVideos();
    }
}
