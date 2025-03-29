<?php

namespace Tests\Feature\Exercises;

use App\Models\User;
use Database\Seeders\ExerciseCategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetExerciseCategoriesTest extends TestCase
{
    use RefreshDatabase;

    const GET_EXERCISE_CATEGORIES_URL = '/api/v1/exercise/categories';
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ExerciseCategorySeeder::class);
        User::factory()->create();
        $this->user = User::first();
        $this->actingAs($this->user);
    }

    public function test_exercise_categories_can_be_fetched(): void
    {
        $response = $this->get(self::GET_EXERCISE_CATEGORIES_URL);

        $response->assertStatus(200);
    }
}
