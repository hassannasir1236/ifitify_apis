<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\OtpRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        UserRepository $userRepository,
        OtpRepository $otpRepository,
    ) {
        $request->validate([
            'email' => 'required|exists:users,email|email',
            'password' => 'required|min:8|string|confirmed'
        ]);

        $user = $userRepository->getUserByEmail($request->email);

        $userRepository->update($user, ['password' => $request->password]);
        return response()->json('Password Reset Successful', 200);
    }
}
