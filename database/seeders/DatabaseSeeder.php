<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GoalSeeder::class);
        \App\Models\User::factory(10)->create();
        $this->call(TrainingLevelSeeder::class);
        $this->call(ExerciseCategorySeeder::class);
        $this->call(ExerciseEquipmentSeeder::class);
        $this->call(ExerciseSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(GoalLevelSeeder::class);
        $this->call(UserLevelSeeder::class);
        $this->call(GoalUserLevelSeeder::class);
    }
}
