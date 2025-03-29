<?php

namespace Tests\Feature\User;

use App\Models\Exercise;
use App\Models\ExerciseCategory;
use App\Models\ExerciseEquipment;
use App\Models\TrainingLevel;
use App\Models\User;
use App\Models\UserExercise;
use App\Models\Video;
use Database\Seeders\ExerciseCategorySeeder;
use Database\Seeders\ExerciseEquipmentSeeder;
use Database\Seeders\ExerciseSeeder;
use Database\Seeders\TrainingLevelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetExercisePlaylistTest extends TestCase
{
    use RefreshDatabase;

    const GET_EXERCISE_PLAYLIST_URL = '/api/v1/user/new-workouts';
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ExerciseCategorySeeder::class);
        $this->seed(ExerciseSeeder::class);
        $this->seed(TrainingLevelSeeder::class);
        $this->seed(ExerciseEquipmentSeeder::class);
        Exercise::create([
            'id' => Exercise::first()->id,
            'exercise_category_id' => ExerciseCategory::first()->id,
            'training_level_id' => TrainingLevel::first()->id,
            'exercise_equipment_id' => ExerciseEquipment::first()->id,
            'image_url' => 'videos/video1.mp3'
        ]);
        User::factory()->create();
        $this->user = User::first();
        $this->actingAs($this->user);
        UserExercise::create([
            'user_id' =>   $this->user->id,
            'exercise_id' =>  Exercise::first()->id,
            'custom_workout_id' => "123456789044333",
            'name' => "First Workout"
        ]);
    }
    public function test_user_can_get_exercise_playlist(): void
    {
        $response = $this->get(self::GET_EXERCISE_PLAYLIST_URL);

        $response->assertStatus(200);
    }
}
