<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\SaveIntervalWorkoutAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveIntervalWorkoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, SaveIntervalWorkoutAction $action)
    {
        $request->validate([
            'videos' => 'required|array',
            'interval_workout_name' => 'nullable|string',
            'full_screen_duration' => 'required|integer',
            'preparation_duration' => 'required|integer',
            'rest_between_events' => 'required|integer',
            'number_of_exercises' => 'integer|required',
            'number_of_sets' => 'integer|required',
        ]);

        $action->execute($request);
        return response()->json( 'interval workout saved', 200);

    }
}
