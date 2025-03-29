<?php

namespace Database\Seeders;

use App\Models\GoalUserLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalUserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GoalUserLevel::insert(
            [
                [
                    'goal_id' => 1,
                    'user_level_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'goal_id' => 2,
                    'user_level_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'goal_id' => 2,
                    'user_level_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'goal_id' => 3,
                    'user_level_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 3,
                    'user_level_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 3,
                    'user_level_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 4,
                    'user_level_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 4,
                    'user_level_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 4,
                    'user_level_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 5,
                    'user_level_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 5,
                    'user_level_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'goal_id' => 5,
                    'user_level_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
