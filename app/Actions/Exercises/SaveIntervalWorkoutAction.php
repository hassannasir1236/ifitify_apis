<?php


namespace App\Actions\Exercises;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

readonly class SaveIntervalWorkoutAction
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function execute(Request $request): bool
    {
        return $this->userRepository->saveIntervalWorkoutDetails($request);
    }
}
