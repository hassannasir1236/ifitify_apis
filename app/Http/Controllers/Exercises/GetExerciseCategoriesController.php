<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\GetExerciseCategoriesAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExerciseCategoryCollection;
use App\Http\Resources\GoalCollection;
use Illuminate\Http\Request;

class GetExerciseCategoriesController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __invoke(GetExerciseCategoriesAction $action)
    {
        $categories =  $action->execute();

        return response()->json(new ExerciseCategoryCollection($categories), 200);

    }
}
