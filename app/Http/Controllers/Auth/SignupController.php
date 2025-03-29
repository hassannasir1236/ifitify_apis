<?php

namespace App\Http\Controllers\Auth;

use App\Actions\User\CreateNewUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;


class SignupController extends Controller
{

    /**
     * Get a JWT via given credentials and create user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(
        SignupRequest $request,
        CreateNewUserAction $createNewUserAction,
    ) {
        $validated = $request->validated();

        $validated['start_height'] = $validated['height'];
        $validated['start_height_unit'] = $validated['height_metric'];
        $validated['start_weight'] = $validated['weight'];
        $validated['start_weight_unit'] = $validated['weight_metric'];

        $validated['user_level_id'] = implode(',', $validated['user_level_ids']);
        $validated['goal_id'] = implode(',', $validated['goal_ids']);

        $user = $createNewUserAction->execute($validated);

        $token =  auth()->login($user);

        return response()->json(['token' => $token,
            'user' => new UserResource($user)], 200);

    }
}
