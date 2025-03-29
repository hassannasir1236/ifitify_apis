<?php

namespace App\Actions\Goal;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class ChangeGoalAction
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function execute(string $goalId): bool
    {
        return $this->userRepository->updateUserGoal($goalId);
    }
}
