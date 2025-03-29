<?php

namespace App\Actions\Exercises;

use App\Models\ExerciseCategory;
use App\Repositories\ExerciseCategoryRepository;

class CreateExerciseCategoriesAction
{
    public function __construct(
        private readonly ExerciseCategoryRepository $categoryRepository
    ) {
    }

    public function execute(array $data): ExerciseCategory
    {
        $category = $this->categoryRepository->getExerciseCategoryByName($data['title']);
        
        if(is_null($category)){
            return $this->categoryRepository->create($data);
        }

        return $category;
    }
}
