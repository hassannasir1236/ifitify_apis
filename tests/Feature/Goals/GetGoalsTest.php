<?php

namespace Tests\Feature\Goals;

use Database\Seeders\GoalSeeder;
use Database\Seeders\UserLevelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetGoalsTest extends TestCase
{
    use RefreshDatabase;

    const GET_ALL_GOALS_URL = '/api/v1/fitness-goals';
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(GoalSeeder::class);
        $this->seed(UserLevelSeeder::class);

    }

    public function test_all_goals_can_be_fetched(): void
    {
        $response = $this->get(self::GET_ALL_GOALS_URL );

        $response->assertStatus(200);
    }
}
