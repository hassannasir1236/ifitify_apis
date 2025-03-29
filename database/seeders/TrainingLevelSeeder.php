<?php

namespace Database\Seeders;

use App\Models\TrainingLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrainingLevel::insert(
            [
                [
                    'title' => "Stabilization Endurance",
                    'description' => "Mobility & Stability. Posture Correction",
                    'icon' => 'icons/box_stepup.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Strength Endurance",
                    'description' => "Muscular Endurance & Prime Movers",
                    'icon' => 'icons/bodyweight_squats.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Muscular Development",
                    'description' => "Muscular strength and hypertrophy",
                    'icon' => 'icons/barbell_back_squats.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Maximal Strength",
                    'description' => "Core strength, Maximal muscular strength",
                    'icon' => 'icons/deadlift_icon.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Power",
                    'description' => "Speed, agility and quickness",
                    'icon' => 'icons/high_jump.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        );
    }
}
