<?php

namespace App\Http\Controllers\User;

use App\Actions\User\EditProgressImageAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UploadBeforeImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        EditProgressImageAction $action
    ) {
        $request->validate([
            'before_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $image = $request->file('before_image');
        $name = uniqid() . auth()->user()->first_name . "." . $image->guessExtension();
        $destinationPath = public_path('progress_image');

        $data = ['previous_image_url' => 'progress_image/' . $name];
        $action->execute(auth()->user(), $data);
        $image->move($destinationPath, $name);


        return response()->json(new UserResource(auth()->user()->refresh()), 200);
    }
}
