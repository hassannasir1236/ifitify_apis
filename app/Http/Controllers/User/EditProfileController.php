<?php

namespace App\Http\Controllers\User;

use App\Actions\User\EditUserProfileAction;
use App\Actions\User\GetUserByIdAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExerciseCategoryCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EditProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,
                             EditUserProfileAction $action,
                             GetUserByIdAction $getProfileAction)
    {
        $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255',  Rule::unique('users')->ignore(auth()->user()->id)],
            'gender' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'weight' => ['nullable', 'numeric'],
            'weight_metric' => ['nullable', 'string'],
            'height' => ['nullable', 'numeric'],
            'height_metric' => ['nullable', 'string'],
            'country_code' => 'required_with:phone|string| max:8',
            'phone' => ['required_with:country_code','string','max:25',Rule::unique('users')->ignore(auth()->user()->id)],
        ]);

        $data = [];

        if(isset($request->country_code)){
            $data['country_code'] = $request->country_code;
        }
        if(isset($request->phone)){
            $data['phone'] = $request->phone;
        }
        if(isset($request->height)){
            $data['start_height'] = $request->height;
        }
        if(isset($request->height_metric)){
            $data['start_height_unit'] = $request->height_metric;
        }
        if(isset($request->weight)){
            $data['start_weight'] = $request->weight;
        }
        if(isset($request->weight_metric)){
            $data['start_weight_unit'] = $request->weight_metric;
        }
        if(isset($request->date_of_birth)){
            $data['date_of_birth'] = $request->date_of_birth;
        }
        if(isset($request->email)){
            $data['email'] = $request->email;
        }
        if(isset($request->first_name)){
            $data['first_name'] = $request->first_name;
        }
        if(isset($request->last_name)){
            $data['last_name'] = $request->last_name;
        }
        if(isset($request->gender)){
            $data['gender'] = $request->gender;
        }
        $action->execute(auth()->user(), $data);

        $user = $getProfileAction->execute(auth()->user()->id);

        return response()->json(new UserResource($user), 200);

    }
}
