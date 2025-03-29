<?php

namespace Database\Seeders;

use App\Models\UserLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserLevel::insert(
            [
                [
                    'title' => "Beginner",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Intermediate",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Advanced",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Elite",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Athlete",
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        );
    }
}
