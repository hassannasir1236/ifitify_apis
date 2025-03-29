<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OtpRepository
{
    public function create(User $user): string
    {
        $otp = rand(1000, 9999);

        DB::table("password_reset_tokens")->insert(
            [
                'email' => $user->email,
                'token' => $otp,
                'expire_at' => now()->addMinutes(5),
                'created_at' => now()
            ]
        );
        return strval($otp);
    }

    public function getUserOtp(User $user): string
    {
        $otpRecord = DB::table("password_reset_tokens")
            ->where("email", $user->email)->first();

        return strval($otpRecord->token);
    }

    public function update(User $user): string
    {
        $otp = rand(1000, 9999);

        DB::table("password_reset_tokens")
            ->where('email', $user->email)->update(
                [
                    'token' => $otp,
                    'expire_at' => now()->addMinutes(5),
                ]
            );
        return strval($otp);
    }

    public function hasOtp(User $user): bool
    {
        return DB::table("password_reset_tokens")
            ->where("email", $user->email)->exists();
    }

    public function isSelfOtp(User $user, string $otp): bool
    {
        return DB::table("password_reset_tokens")
            ->where("email", $user->email)->where('token', $otp)->exists();
    }

    public function hasExpiredOtp(User $user): bool
    {
        return DB::table("password_reset_tokens")
            ->where("email", $user->email)
            ->where("expire_at", '<=', now())->exists();
    }
}
