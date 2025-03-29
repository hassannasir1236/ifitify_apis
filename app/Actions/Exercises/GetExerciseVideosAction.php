<?php

namespace App\Actions\Exercises;

use App\Repositories\ExerciseVideosRepository;
use Illuminate\Database\Eloquent\Collection;

class GetExerciseVideosAction
{
    public function __construct(
        private readonly ExerciseVideosRepository $videosRepository
    ) {
    }

    public function execute(array $categories, array $equipments): Collection
    {
        return $this->videosRepository->get($categories, $equipments);
    }
}
