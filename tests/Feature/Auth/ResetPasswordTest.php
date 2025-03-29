<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Repositories\OtpRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    const RESET_PASSWORD_URL = '/api/auth/password/reset';
    protected $user, $otpRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->otpRepository = new OtpRepository();
        DB::table("password_reset_tokens")->insert(
            [
                'email' => $this->user->email,
                'token' => 12345,
                'expire_at' => now()->addMinutes(5),
                'created_at' => now()
            ]
        );
    }
    public function test_that_password_can_be_reset(): void
    {
        $response = $this->postjson(self::RESET_PASSWORD_URL, [
            "email" => $this->user->email,
            "password" => "password12345",
            "password_confirmation" => "password12345"
        ]);
        $response->assertStatus(200);
    }

    public function test_that_password_cannot_be_reset_with_invalid_email(): void
    {
        $response = $this->postjson(self::RESET_PASSWORD_URL, [
            "email" => 'nonexistentemail@gmail.com',
            "password" => "password12345",
            "password_confirmation" => "password12345"
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            "errors" => [
                "email" => [
                    "The selected email is invalid."
                ]
            ]
        ]);
    }


}
