<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\CreateExerciseAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateExerciseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke( 
    Request $request,
    CreateExerciseAction $action)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|numeric|exists:exercise_categories,id'
        ]);

        $data = [
            'name' => $request->name,
            'exercise_category_id' => $request->category_id
        ];

        $action->execute($data);

        return [
            'message' => 'exercise created'
        ];
    }
}
