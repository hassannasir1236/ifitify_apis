<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyOtpRequest;
use App\Repositories\OtpRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class VerifyOTPController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        VerifyOtpRequest $request,
        OtpRepository $otpRepository,
        UserRepository $userRepository,
    )
    {

        $request->validated();

        $user = $userRepository->getUserByEmail($request->email);

        $hasOtp = $otpRepository->hasOtp(
            $user
        );

        $isExpiredOtp = $otpRepository->hasExpiredOtp(
            $user
        );

        $isSelfOtp = $otpRepository->isSelfOtp($user, strval($request->otp));

        if (!$hasOtp || !$isSelfOtp) {
            return response()->json('The selected otp is invalid.', 400);
        }

        if ($isExpiredOtp) {
            return response()->json('Otp has expired.', 400);
        }
        return response()->json('Otp Verified.', 200);

    }
}
