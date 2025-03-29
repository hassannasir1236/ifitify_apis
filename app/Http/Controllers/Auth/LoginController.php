<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
class LoginController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        $credentials = request(['email', 'password']);
     
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid Email Or Password'], 400);
        }
        return $this->respondWithToken($token, auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user)
    {
        return response()->json(['token' => $token,
            'user' => new UserResource($user)], 200);

    }
    // delete user
    public function delete_user(Request $request)
    {
        // Validate the user_id input
        $request->validate([
            'user_id' => 'required|integer|exists:users,id', 
        ]);
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'User not found.'], 404);
        }
}
    public function test(){
        echo 'here';
    }
}
