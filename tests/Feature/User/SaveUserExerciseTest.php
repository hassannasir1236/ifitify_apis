<?php

namespace Tests\Feature\User;

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

class SaveUserExerciseTest extends TestCase
{
    use RefreshDatabase;

    const SAVE_EXERCISE_VIDEO_URL = '/api/v1/user/new-workout/create';
    protected $user, $video;

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
        $this->video = Exercise::first();
    }
    public function test_user_can_save_exercise_videos(): void
    {
        $response = $this->postjson(self::SAVE_EXERCISE_VIDEO_URL, [
            'videos' => [$this->video->id],
            'name' => 'First Workout'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('user_exercises', [
            'user_id' => $this->user->id,
            'exercise_id' => $this->video->id,
            'name' => 'First Workout'
        ]);
    }
}
