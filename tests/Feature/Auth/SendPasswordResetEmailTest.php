<?php

namespace Tests\Feature\Auth;

use App\Mail\OtpSent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetEmailTest extends TestCase
{
    use RefreshDatabase;

    const SEND_EMAIL_URL = '/api/auth/otp/send';
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        User::factory()->create();
        $this->user = User::first();
        Mail::fake();
    }
    public function test_password_reset_email_can_be_sent(): void
    {
        $response = $this->postjson(self::SEND_EMAIL_URL, [
            "email" => $this->user->email,
        ]);

        $response->assertStatus(200);

        Mail::assertSent(OtpSent::class, function (OtpSent $mail) {
            $mail->assertSeeInHtml('Reset Password');
            return true;
        });
    }
    public function test_password_reset_email_cannot_be_sent_to_non_existing_email(): void
    {
        $response = $this->postjson(self::SEND_EMAIL_URL, [
            "email" => "nonexistingemail@email.com",
        ]);

        $response->assertStatus(422);

    }

}
