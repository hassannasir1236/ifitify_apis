<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\GetIntervalWorkoutAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserIntervalWorkoutCollection;

class GetIntervalWorkoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GetIntervalWorkoutAction $action)
    {
        $exercises = $action->execute();

        return response()->json( new UserIntervalWorkoutCollection($exercises), 200);
    }
}
