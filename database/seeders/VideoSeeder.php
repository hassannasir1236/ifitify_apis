<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::insert(
            [
                [
                    'exercise_id' => 1,
                    'exercise_category_id' => 2,
                    'exercise_equipment_id' => 12,
                    'training_level_id' => json_encode([2, 3, 4, 5]),
                    'video_url' => 'exercises/crossfit_assault_airbike.mp4',
                    'image_url' => 'exercises/crossfit_assault_airbike.png',
                    'instructions' => " 1. Adjust the Seat: Set the seat height so your leg is almost fully extended at the pedal's lowest point.
                                        2. Learn the Display: Familiarize yourself with the monitor to track your workout and settings.
                                        3. Start Pedaling: Begin with a warm-up at a moderate pace, getting used to the bike's feel.
                                        4. Try a Simple Workout: After warming up, do a short interval workout, like 20 seconds of hard pedaling followed by 10 seconds of rest, for a few minutes.",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'exercise_id' => 2,
                    'exercise_category_id' => 2,
                    'exercise_equipment_id' => 17,
                    'training_level_id' => json_encode([2, 3, 4, 5]),
                    'video_url' => 'exercises/runners_manual_treadmill.mp4',
                    'image_url' => 'exercises/runners_manual_treadmill.png',
                    'instructions' => " 1. Start Safely: Begin at the front of the treadmill. 
                                        2. Place your feet on the sides (not on the belt) and hold onto the handrails.
                                        3. Initiate Movement: Gradually lean forward and start walking, allowing your weight to initiate belt movement.",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'exercise_id' => 3,
                    'exercise_category_id' => 2,
                    'exercise_equipment_id' => 14,
                    'training_level_id' => json_encode([1, 2, 3, 4, 5]),
                    'video_url' => 'exercises/rowing_machine.mp4',
                    'image_url' => 'exercises/rowing_machine.png',
                    'instructions' => " 1. Adjust: Set the foot straps to fit snugly around your feet.
                                        2. Grip: Hold the handle with a firm but comfortable grip.
                                        3. Position: Start with legs bent, body leaning forward, and arms extended towards the machine.
                                        4. Move: Push back with your legs first, then lean back, and finally pull the handle to your lower ribs. 
                                        5. Reverse the sequence to return to the starting position",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'exercise_id' => 4,
                    'exercise_category_id' => 4,
                    'exercise_equipment_id' => 3,
                    'training_level_id' => json_encode([3, 4, 5]),
                    'video_url' => 'exercises/barbel_romania_deadlift.mp4',
                    'image_url' => 'exercises/barbel_romania_deadlift.png',
                    'instructions' => " 1. Stand: Feet hip-width apart, holding the barbell with a shoulder-width grip.
                                        2. Hinge: Bend slightly at the knees, hinge at your hips to lower the barbell, keeping it close to your legs.
                                        3. Lower: Lower the barbell on midcalf until you feel a stretch in your hamstrings, keeping your back straight.
                                        4. Lift: Return to standing by driving through your heels and extending your hips.",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'exercise_id' => 5,
                    'exercise_category_id' => 4,
                    'exercise_equipment_id' => 1,
                    'training_level_id' => json_encode([2, 3, 4, 5]),
                    'video_url' => 'exercises/bulgarian_split_squat.mp4',
                    'image_url' => 'exercises/bulgarian_split_squat.png',
                    'instructions' => " 1. Position: Stand facing away from a bench, extend one leg 2ft away from the bench, 
                                        2. Stand and Rest one leg on the top of that foot on the bench to fiund balance
                                        3. Lower: Bend your front knee to lower your body towards the ground, keeping your torso upright.
                                        4. Depth: Go down until your front thigh is nearly parallel to the floor.
                                        5. Rise: Push through your front heel to return to the starting position.",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'exercise_id' => 6,
                    'exercise_category_id' => 7,
                    'exercise_equipment_id' => 3,
                    'training_level_id' => json_encode([3, 4, 5]),
                    'video_url' => 'exercises/barbel_clean.mp4',
                    'image_url' => 'exercises/barbel_clean.png',
                    'instructions' => " 1. Start Position: Stand with feet shoulder-width apart, barbell over your toes. Bend at the hips and knees, grip the barbell wider than shoulder width.
                                        2. Lift: Lift the barbell by extending your legs, keeping the bar close to your body.
                                        3. Shrug and Catch: When the bar reaches maximum height, shrug your shoulders and quickly squat under the bar, catching it at shoulder level with elbows forward.
                                        4. Stand Up: Stand up straight, keeping the barbell at shoulder height.",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'exercise_id' => 7,
                    'exercise_category_id' => 5,
                    'exercise_equipment_id' => 3,
                    'training_level_id' => json_encode([2, 3, 4, 5]),
                    'video_url' => 'exercises/incline_barbel_chest_press.mp4',
                    'image_url' => 'exercises/30_barbel_incline_chest_press.png',
                    'instructions' => " 1. Setup: Adjust the bench to a 30-45 degree incline. Sit with your back against the bench, holding dumbbells at shoulder height, palms facing forward.
                                        2. Press: Extend your arms, pushing the dumbbells up until they're directly above your chest, without locking your elbows.
                                        3. Lower: Slowly bring the dumbbells down to the sides of your chest.
                                        4. Repeat: Perform your desired number of repetitions.",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'exercise_id' => 8,
                    'exercise_category_id' => 4,
                    'exercise_equipment_id' => 5,
                    'training_level_id' => json_encode([3, 4, 5]),
                    'video_url' => 'exercises/dumbbell_split_lunges.mp4',
                    'image_url' => 'exercises/dumbbell_split_lunges.png',
                    'instructions' => " 1. Position: Stand with one foot forward and the other back, holding dumbbells at your sides.
                                        2. Lower: Bend both knees to lower your body, keeping your front knee above the ankle.
                                        3. Depth: Lower until your back knee nearly touches the ground.
                                        4. Rise: Push through your front heel to return to the starting position.",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'exercise_id' => 9,
                    'exercise_category_id' => 5,
                    'exercise_equipment_id' => 5,
                    'training_level_id' => json_encode([1, 2, 3, 4, 5]),
                    'video_url' => 'exercises/dumbbell_front_raises.mp4',
                    'image_url' => 'exercises/dumbbell_front_raises.png',
                    'instructions' => " 1. Stand: With feet shoulder-width apart, hold dumbbells in front of your thighs, palms facing your body.
                                        2. Lift: Raise the dumbbells straight up in front of you to shoulder height, keeping your arms slightly bent.
                                        3. Lower: Slowly lower the dumbbells back to the starting position.
                                        4. Repeat: Complete your desired number of repetitions.",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'exercise_id' => 10,
                    'exercise_category_id' => 5,
                    'exercise_equipment_id' => 5,
                    'training_level_id' => json_encode([1, 2, 3, 4, 5]),
                    'video_url' => 'exercises/dumbbell_hammer_curl.mp4',
                    'image_url' => 'exercises/dumbbell_hammer_curls.png',
                    'instructions' => " 1. Stand: With feet hip-width apart, hold dumbbells at your sides, palms facing inwards.
                                        2. Curl: Curl the dumbbells towards your shoulders, keeping your palms facing each other.
                                        3. Hold: Briefly hold the position at the top.
                                        4. Lower: Slowly lower the dumbbells back to the starting position.",
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'exercise_id' => 11,
                    'exercise_category_id' => 5,
                    'exercise_equipment_id' => 5,
                    'training_level_id' => json_encode([3, 4, 5]),
                    'video_url' => 'exercises/renegade_rows.mp4',
                    'image_url' => 'exercises/renegade_row.png',
                    'instructions' => " 1. Position: Place two dumbbells on the ground parallel to each other, slightly wider than shoulder-width apart. Position a bench behind the dumbbells.
                                        2. Setup: Get into a high plank position with your hands on the dumbbells and your feet elevated on the bench, keeping your body straight.
                                        3. Row: Pull one dumbbell towards your ribcage while stabilizing your body with the other arm.
                                        4. Alternate: Lower the dumbbell back to the starting position and repeat with the other arm.",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
