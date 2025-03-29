<?php

namespace Database\Seeders;

use App\Models\ExerciseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExerciseCategory::insert(
            [
                [
                    'title' => "Core",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Cardio",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Functional",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Lower Body",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Upper Body",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Stretching",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => "Full Body",
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        );
    
    }
}
