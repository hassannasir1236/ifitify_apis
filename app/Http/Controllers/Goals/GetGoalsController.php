<?php

namespace App\Http\Controllers\Goals;

use App\Actions\Goal\GetGoalsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\GoalCollection;
use Illuminate\Http\Request;

class GetGoalsController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __invoke(GetGoalsAction $action)
    {
        $goals =  $action->execute();

        return response()->json(new GoalCollection($goals), 200);

    }
}
