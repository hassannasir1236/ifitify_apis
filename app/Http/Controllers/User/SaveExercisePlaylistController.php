<?php

namespace App\Http\Controllers\User;

use App\Actions\Exercises\SaveUserExerciseAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercise;
use Illuminate\Support\Str;

class SaveExercisePlaylistController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, SaveUserExerciseAction $action)
    {
        $request->validate([
            'videos' => 'required|array',
            'name' => 'nullable|string',
        ]);
        $existingVideos = Exercise::whereIn('id', $request->videos)->pluck('id')->toArray();

        if (count($existingVideos) !== count($request->videos)) {
            return response()->json([
                'message' => 'One or more video IDs do not exist in the our record.',
            ], 422);
        }

        $action->execute($request->videos, $request->name);

       // return response()->json( 'message' => 'workout saved', 200);
        return response()->json([
           'message' => 'workout saved',
        ], 200);
    }
}
