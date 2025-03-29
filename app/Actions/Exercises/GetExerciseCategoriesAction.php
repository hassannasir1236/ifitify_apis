<?php

namespace App\Actions\Exercises;

use App\Repositories\ExerciseCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class GetExerciseCategoriesAction
{
    public function __construct(
        private readonly ExerciseCategoryRepository $categoryRepository
    ) {
    }

    public function execute(): Collection
    {
        return $this->categoryRepository->get();
    }
}
