<?php

namespace Tests\Feature\Exercises;

use App\Models\Exercise;
use App\Models\ExerciseCategory;
use App\Models\ExerciseEquipment;
use App\Models\TrainingLevel;
use App\Models\User;
use App\Models\Video;
use Database\Seeders\ExerciseCategorySeeder;
use Database\Seeders\ExerciseEquipmentSeeder;
use Database\Seeders\ExerciseSeeder;
use Database\Seeders\TrainingLevelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetExerciseVideosTest extends TestCase
{
    use RefreshDatabase;

    const GET_EXERCISE_VIDEOS_URL = '/api/v1/exercise/videos';
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
    }

    public function test_exercise_videos_can_be_fetched(): void
    {
        $response = $this->postjson(self::GET_EXERCISE_VIDEOS_URL, [
            'categories' => [ExerciseCategory::first()->id],
            'training_level' => TrainingLevel::first()->id,
            'equipments' => [ExerciseEquipment::first()->id],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'videos' => []
        ]);
    }
}
