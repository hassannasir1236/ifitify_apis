<?php

namespace Tests\Feature\Exercises;

use App\Models\User;
use Database\Seeders\ExerciseEquipmentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetExerciseEquipmentsTest extends TestCase
{
    use RefreshDatabase;

    const GET_EXERCISE_EQUIPMENTS_URL = '/api/v1/exercise/equipments';
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ExerciseEquipmentSeeder::class);
        User::factory()->create();
        $this->user = User::first();
        $this->actingAs($this->user);
    }

    public function test_exercise_equipments_can_be_fetched(): void
    {
        $response = $this->get(self::GET_EXERCISE_EQUIPMENTS_URL);

        $response->assertStatus(200);
    }
}
