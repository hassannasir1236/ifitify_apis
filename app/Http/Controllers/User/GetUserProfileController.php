<?php

namespace App\Http\Controllers\User;

use App\Actions\User\GetUserByIdAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\GoalCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class GetUserProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        GetUserByIdAction $action
    ) {
        $user = $action->execute(auth()->user()->id);

        return response()->json(new UserResource($user), 200);

    }
}
