<?php

namespace App\Actions\Exercises;

use App\Models\Video;
use App\Repositories\ExerciseCategoryRepository;
use App\Repositories\ExerciseVideosRepository;
use Illuminate\Support\Facades\DB;

class CreateExerciseVideoAction
{
    public function __construct(
        private readonly ExerciseVideosRepository $videoRepository,
        private readonly ExerciseCategoryRepository $categoryRepository
    ) {
    }

    public function execute(array $data): Video
    {
        DB::table('exercise_categories')
        ->where('id',$data['exercise_category_id'])
        ->update(['deleted_at' => null]);

        return $this->videoRepository->create($data);
    }
}
