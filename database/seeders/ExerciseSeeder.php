<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exercise::insert(
            [
                [
                    'name' => "Cross Assault Airbike ",
                    'exercise_category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Runners Manual treadmill",
                    'exercise_category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Rowing Machine",
                    'exercise_category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Barbell Romania Deadlift",
                    'exercise_category_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Bulgarian Squats",
                    'exercise_category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => "Barbell Clean",
                    'exercise_category_id' => 7,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => "30 Degree Incline Chest Press",
                    'exercise_category_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => "Dumbbell Split Lunges",
                    'exercise_category_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => "Dummbell Front Raises",
                    'exercise_category_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => "Dummbell Hammer Curl",
                    'exercise_category_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => "Bench Renegade Rows",
                    'exercise_category_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
