<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\GetQuickWorkoutsAction;
use App\Actions\Exercises\GetAllQuickWorkoutsAction; // New action
use App\Http\Controllers\Controller;
use App\Http\Resources\QuickWorkoutCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GetQuickWorkoutsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        GetQuickWorkoutsAction $levelAction,
        GetAllQuickWorkoutsAction $allAction
    )
    {
        $level = $request->route('level');

        if (is_null($level)) {
            // If no level is provided, call the new action
            $quickworkouts = $allAction->execute();
            return response()->json(new QuickWorkoutCollection($quickworkouts), 200);
        }

        $validLevels = ['beginner', 'intermediate', 'advanced'];
        $level = Str::lower($level);

        // Check if the provided level is valid
        if (!in_array($level, $validLevels)) {
            // If not valid, find the closest match
            $closestMatch = $this->findClosestMatch($level, $validLevels);

            if ($closestMatch) {
                // If a close match is found, use it and return a 200 response with a warning
                $quickworkouts = $levelAction->execute($closestMatch);
                return response()->json(
                    new QuickWorkoutCollection($quickworkouts)
                    , 200);
            } else {
                // If no close match, return a 400 Bad Request
                return response()->json([
                    'error' => "Invalid level provided. Valid levels are: " . implode(', ', $validLevels)
                ], 400);
            }
        }

        // If level is valid, proceed as normal
        $quickworkouts = $levelAction->execute($level);

        if (!is_null($quickworkouts)) {
            return response()->json(new QuickWorkoutCollection($quickworkouts), 200);
        }

        return response()->json([], 200);
    }

    /**
     * Find the closest matching string in an array.
     */
    private function findClosestMatch(string $input, array $possibilities): ?string
    {
        $closest = null;
        $closestDistance = PHP_INT_MAX;

        foreach ($possibilities as $possibility) {
            $distance = levenshtein($input, $possibility);
            if ($distance < $closestDistance) {
                $closest = $possibility;
                $closestDistance = $distance;
            }
        }

        // Only return a match if it's reasonably close (e.g., distance <= 3)
        return $closestDistance <= 3 ? $closest : null;
    }
}
