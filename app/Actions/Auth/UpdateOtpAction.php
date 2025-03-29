<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Repositories\OtpRepository;

class UpdateOtpAction
{
    public function __construct(
        private readonly OtpRepository $otpRepository,
    ) {
    }

    public function execute(User $user) : string
    {
        $otp = $this->otpRepository->update($user);
        return $otp;
    }
}