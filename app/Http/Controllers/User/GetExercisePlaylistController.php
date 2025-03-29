<?php

namespace App\Http\Controllers\User;

use App\Actions\Exercises\GetUserExerciseAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserExerciseCollection;
use Illuminate\Http\Request;

class GetExercisePlaylistController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GetUserExerciseAction $action)
    {
        $exercises = $action->execute();

        return response()->json( new UserExerciseCollection($exercises), 200);
    }
}
