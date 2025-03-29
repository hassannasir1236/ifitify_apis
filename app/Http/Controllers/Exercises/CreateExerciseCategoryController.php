<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\CreateExerciseCategoriesAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateExerciseCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        CreateExerciseCategoriesAction $action
    ) {
        $request->validate([
            'title' => 'required|string'
        ]);

        $data = [
            'title' => $request->title
        ];

        $action->execute($data);

        return [
            'message' => 'category created'
        ];
    }
}
