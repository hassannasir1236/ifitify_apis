<?php

namespace App\Http\Controllers\User;

use App\Actions\User\EditUserProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UploadProfilePictureController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        EditUserProfileAction $action
    ) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $image = $request->file('image');
        $name = uniqid() . auth()->user()->first_name . "." . $image->guessExtension();
        $destinationPath = public_path('avatar');

        $data = ['avatar' => 'avatar/' . $name];
        $action->execute(auth()->user(), $data);
        $image->move($destinationPath, $name);

        return response()->json(new UserResource(auth()->user()->refresh()), 200);

    }
}
