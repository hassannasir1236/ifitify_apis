<?php

namespace Tests\Feature\Exercises;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateExerciseCategoryTest extends TestCase
{
    use RefreshDatabase;

    const CREATE_EXERCISE_CATEGORY_URL = '/api/v1/exercise/category/create';

    public function test_create_an_exercise_category(): void
    {
        $response = $this->postJson(self::CREATE_EXERCISE_CATEGORY_URL, [
            'title' => 'new category'
        ]);

        $response->assertStatus(200);
        
        $this->assertDatabaseHas('exercise_categories', [
            'title' => 'new category',
        ]);

    }
}
