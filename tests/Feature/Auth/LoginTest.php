<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\GoalSeeder;
use Database\Seeders\UserLevelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    const AUTH_URL = '/api/auth/login';
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        User::factory(3)->create();
        $this->user = User::first();
        $this->seed(GoalSeeder::class);
        $this->seed(UserLevelSeeder::class);
    }

    public function test_a_user_can_signin_by_email(): void
    {

        $response = $this->postjson(self::AUTH_URL, [
            "email" => $this->user->email,
            "password" => "password",
        ]);

        $response->assertStatus(200);
    }

    public function test_a_user_cannot_signin_with_wrong_credentials(): void
    {

        $response = $this->postjson(self::AUTH_URL, [
            "email" => $this->user->email,
            "password" => "wrongPassword",
        ]);

        $response->assertStatus(400);
    }

    public function test_a_user_cannot_login_with_non_existent_email(): void
    {

        $response = $this->postjson(self::AUTH_URL, [
            "email" => "4995858595@email.com",
            "password" => "kkkfjffj",
        ]);

        $response->assertStatus(400);
    }
    public function test_a_user_cannot_login_with_empty_fields(): void
    {

        $response = $this->postjson(self::AUTH_URL, [
            "email" => " ",
            "password" => " ",
        ]);

        $response->assertStatus(400);
    }

    public function test_a_user_cannot_login_with_wrong_email_format(): void
    {
        $response = $this->postjson(self::AUTH_URL, [
            "email" => "email@email",
            "password" => "password",
        ]);

        $response->assertStatus(400);
    }
}
