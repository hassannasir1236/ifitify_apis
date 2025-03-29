<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Repositories\OtpRepository;

class CreateNewOtpAction
{
    public function __construct(
        private readonly OtpRepository $otpRepository,
    ) {
    }

    public function execute(User $user) : string
    {
        $otp = $this->otpRepository->create($user);
        return $otp;
    }
}