<?php

namespace Database\Seeders;

use App\Models\Goal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Goal::insert(
            [
                [
                    'title' => "Mobility & Stability",
                    'description' => "Move, Feel & Live better",
                    'icon' => 'icons/mobility_and_stability_icon.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Loose weight",
                    'description' => "Burn fat, Be Healthy",
                    'icon' => 'icons/loose_weight_icon.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Get fitter",
                    'description' => "Tone up, Get leaner",
                    'icon' => 'icons/get_fitter_icon.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Gain Muscles",
                    'description' => "Build Mass & Be strong",
                    'icon' => 'icons/gain_muscles_icon.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'title' => "Build Endurance",
                    'description' => "Endurance & stamina",
                    'icon' => 'icons/build_endurance_icon.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],


            ]
        );
    }
}
