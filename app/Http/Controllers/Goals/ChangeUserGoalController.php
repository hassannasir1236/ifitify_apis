<?php

namespace App\Http\Controllers\Goals;

use App\Actions\Goal\ChangeGoalAction;
use App\Actions\User\GetUserByIdAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class ChangeUserGoalController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        ChangeGoalAction $action,
        GetUserByIdAction $userAction
    )
    {
        // $request->validate([
        //     'goal_id' => 'required|numeric|exists:goals,id',
        //     'user_level_id' => 'required|numeric|exists:user_levels,id',
        // ]);

        // $action->execute($request->goal_id);


        // $request->validate([
        //     'goal_id' => 'required|array',
        //     'goal_id.*' => 'numeric|exists:goals,id',
        //     'user_level_id' => 'required|numeric|exists:user_levels,id',
        // ]);
        // $goalIds = implode(',', $request->goal_id);

        // $action->execute($goalIds);
        // auth()->user()->update(['user_level_id' => $request->user_level_id]);
        // $user = $userAction->execute(auth()->user()->id);



        $request->validate([
            'goal_ids' => 'required|array',
            'goal_ids.*' => 'numeric|exists:goals,id',
            'user_level_ids' => 'required|array',
            'user_level_ids.*' => 'numeric|exists:user_levels,id',
        ]);
        
        $goalIds = implode(',', $request->goal_ids);
        $userLevelIds = implode(',', $request->user_level_ids);
        
        $action->execute($goalIds);
        
        // Example: If you need to store all user_level_id in a column as a comma-separated string
        auth()->user()->update(['user_level_id' => $userLevelIds]);
        
        // Pass user ID to some action (this part stays the same)
        $user = $userAction->execute(auth()->user()->id);
        
        return response()->json(new UserResource($user), 200);
    }
}
