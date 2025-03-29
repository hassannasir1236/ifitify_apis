<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GoalLevel;

class GoalLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GoalLevel::insert(
            [
                [
                    'goal_id' => 1,
                    'training_level_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'goal_id' => 2,
                    'training_level_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 2,
                    'training_level_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 3,
                    'training_level_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 3,
                    'training_level_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 3,
                    'training_level_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'goal_id' => 4,
                    'training_level_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 4,
                    'training_level_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 4,
                    'training_level_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 5,
                    'training_level_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 5,
                    'training_level_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 5,
                    'training_level_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
