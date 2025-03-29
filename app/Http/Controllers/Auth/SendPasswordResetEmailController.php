<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\CreateNewOtpAction;
use App\Actions\Auth\UpdateOtpAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\OtpSent;
use App\Repositories\OtpRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        UserRepository $userRepository,
        CreateNewOtpAction $createNewOtpAction,
        UpdateOtpAction $updateOtpAction,
        OtpRepository $otpRepository,
    ) {
        $request->validate( [
            'email' => 'required|exists:users,email|email',
        ]);

        $user = $userRepository->getUserByEmail($request->email);

        $hasOtp = $otpRepository->hasOtp(
            $user
        );

        $hasExpiredOtp = $otpRepository->hasExpiredOtp(
            $user
        );

        if (!$hasOtp) {
            $otp = $createNewOtpAction->execute($user);

            Mail::to($user->email)->send(new OtpSent(
                $otp
            ));

            return response()->json('OTP Sent', 200);
        }

        if ($hasExpiredOtp) {
            $otp = $updateOtpAction->execute($user);

            Mail::to($user->email)->send(new OtpSent(
                $otp
            ));
            return response()->json('OTP Sent', 200);
        }

        $otp = $otpRepository->getUserOtp(
            $user
        );

        Mail::to($user->email)->send(new OtpSent(
            $otp
        ));

        return response()->json('OTP Sent', 200);
    }
}
