<?php

namespace App\Actions\Exercises;

use App\Repositories\QuickWorkoutsRepository;
use Illuminate\Database\Eloquent\Collection;

class GetQuickWorkoutsAction
{
    public function __construct(
        private readonly QuickWorkoutsRepository $repository
    ) {
    }

    public function execute(string $level): Collection | null
    {
        if($level == 'beginner'){
            return $this->repository->getBeginnerWorkout();
        }
        if($level == 'intermediate'){
            return $this->repository->getIntermediateWorkout();
        }
        if($level == 'advanced'){
            return $this->repository->getAdvancedWorkout();
        }
        return null;
    }
}
