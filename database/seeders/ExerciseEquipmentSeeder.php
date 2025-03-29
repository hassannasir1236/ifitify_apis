<?php

namespace Database\Seeders;

use App\Enums\ExerciseEquipmentType;
use App\Models\ExerciseEquipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExerciseEquipment::insert(
            [
                [
                    'name' => "Bodyweight",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Bosu",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Barbell",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Battle Rop",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Dumb Bell",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Foam Roller",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Kettle Bell",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Medicine Ball",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Pylobox",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Resistance Band",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Swiss Ball",
                    'equipment_type' => ExerciseEquipmentType::ExerciseEquipment->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Air Byke",
                    'equipment_type' => ExerciseEquipmentType::CardiovascularMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Ellipticals",
                    'equipment_type' => ExerciseEquipmentType::CardiovascularMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Rowing Machines",
                    'equipment_type' => ExerciseEquipmentType::CardiovascularMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Stair Chambers/Steppers",
                    'equipment_type' => ExerciseEquipmentType::CardiovascularMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => "Stationary Bykes",
                    'equipment_type' => ExerciseEquipmentType::CardiovascularMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Treadmills",
                    'equipment_type' => ExerciseEquipmentType::CardiovascularMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Cable Machines",
                    'equipment_type' => ExerciseEquipmentType::StrengthTrainingMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Back Machines",
                    'equipment_type' => ExerciseEquipmentType::StrengthTrainingMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Leg Machines",
                    'equipment_type' => ExerciseEquipmentType::StrengthTrainingMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Smith Machines",
                    'equipment_type' => ExerciseEquipmentType::StrengthTrainingMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Chest Machines",
                    'equipment_type' => ExerciseEquipmentType::StrengthTrainingMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'name' => "Biceps/Triceps Machines",
                    'equipment_type' => ExerciseEquipmentType::StrengthTrainingMachines->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
