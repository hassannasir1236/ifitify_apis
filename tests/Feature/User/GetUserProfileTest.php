<?php

namespace Tests\Feature\User;

use App\Models\Goal;
use App\Models\User;
use App\Models\UserLevel;
use Database\Seeders\GoalSeeder;
use Database\Seeders\UserLevelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetUserProfileTest extends TestCase
{
    use RefreshDatabase;

    const GET_PROIFLE_URL = '/api/v1/user/profile';
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        User::factory()->create();
        $this->user = User::first();
        $this->seed(GoalSeeder::class);
        $this->seed(UserLevelSeeder::class);
    }

    public function test_a_user_profile_can_be_retrieved(): void
    {
        $this->actingAs($this->user);
        $response = $this->getJson(self::GET_PROIFLE_URL);

        $response->assertStatus(200);
    }
}
