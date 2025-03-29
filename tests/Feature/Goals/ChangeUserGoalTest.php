<?php

namespace Tests\Feature\Goals;

use App\Models\Goal;
use App\Models\User;
use App\Models\UserLevel;
use Database\Seeders\GoalSeeder;
use Database\Seeders\UserLevelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChangeUserGoalTest extends TestCase
{
    use RefreshDatabase;

    const CHANGE_GOAL_URL = '/api/v1/user/fitness-goal/change';
    protected $user, $goal, $userLevel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(GoalSeeder::class);
        User::factory()->create();
        $this->user = User::first();
        $this->user->update(['goal_id' => 3]);
        $this->actingAs($this->user);
        $this->goal = Goal::first();
        $this->seed(UserLevelSeeder::class);
        $this->userLevel = UserLevel::first();
    }

    public function test_a_user_can_change_his_goal(): void
    {
        $response = $this->postjson(self::CHANGE_GOAL_URL, [
            'goal_id' => $this->goal->id,
            'user_level_id' => $this->userLevel->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'goal_id' => $this->goal->id,
            'user_level_id' => $this->userLevel->id,
        ]);
    }
}
