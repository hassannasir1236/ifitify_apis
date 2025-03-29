<?php

namespace App\Actions\Goal;

use App\Repositories\GoalRepository;
use Illuminate\Database\Eloquent\Collection;

class GetGoalsAction
{
    public function __construct(
        private readonly GoalRepository $goalRepository
    ) {
    }

    public function execute(): Collection
    {
        return $this->goalRepository->get();
    }
}
