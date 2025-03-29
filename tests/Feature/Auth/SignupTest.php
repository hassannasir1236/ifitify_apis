<?php

namespace Tests\Feature\Auth;

use App\Models\Goal;
use App\Models\UserLevel;
use Database\Seeders\GoalSeeder;
use Database\Seeders\UserLevelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignupTest extends TestCase
{
    use RefreshDatabase;

    const AUTH_URL = '/api/auth/signup';
    protected $goal, $userLevel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(GoalSeeder::class);
        $this->seed(UserLevelSeeder::class);
        $this->goal = Goal::first();
        $this->userLevel = UserLevel::first();
    }

    public function test_a_user_can_signup_via_form(): void
    {
        $response = $this->postjson(self::AUTH_URL, [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'country_code' => '+123',
            'phone' => '1234567890',
            'goal_id' => $this->goal->id,
            'height' => 160,
            'height_metric' => 'Cm',
            'weight' => 180,
            'weight_metric' => 'Lb',
            'date_of_birth' => "22-06-1992",
            'gender' => 'Female',
            'user_level_id' => $this->userLevel->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@email.com',
            'country_code' => '+123',
            'phone' => '1234567890',
            'goal_id' => $this->goal->id,
            'user_level_id' => $this->userLevel->id,
            'start_height' => 160,
            'start_height_unit' => 'Cm',
            'start_weight' => 180,
            'start_weight_unit' => 'Lb',
            'gender' => 'Female'
        ]);
    }
}
