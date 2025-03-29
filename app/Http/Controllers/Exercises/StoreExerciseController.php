<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Exercise;

class StoreExerciseController extends Controller
{
    public function generalstore(Request $request)
    {
        try {
            // Validate incoming request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'exercise_category_id' => 'required|integer',
                'exercise_equipment_id' => 'required|integer',
                'user_level' => 'required|integer',
                'goal_id' => 'required|integer',
                'batch_id' => 'required|integer',
                // 'video' => 'nullable|file|mimes:mp4,mov,avi|max:20480', // Max 20MB
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 2MB
            ]);
            // Handle file uploads
            $videoPath = null;
            $imagePath = null;

            if ($request->hasFile('video')) {
                $video = $request->file('video');

                if ($request->exercise_type == 'general_exercise') {
                    $relativeVideoPath = 'exercises/general_exercise/videos/';
                } else {
                    $relativeVideoPath = 'exercises/videos/';
                }

                $destinationVideoPath = public_path($relativeVideoPath);

                if (!file_exists($destinationVideoPath)) {
                    mkdir($destinationVideoPath, 0755, true);
                    $videoName = str_replace(' ', '_', $video->getClientOriginalName());
                    $video->move($destinationVideoPath, $videoName);
                    $videoPath = $relativeVideoPath . $videoName;
                }
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                if ($request->exercise_type == 'general_exercise') {
                    $relativeImagePath = 'exercises/general_exercise/images/';
                } else {
                    $relativeImagePath = 'exercises/images/';
                }
                $destinationImagePath = public_path($relativeImagePath);
                if (!file_exists($destinationImagePath)) {
                    mkdir($destinationImagePath, 0755, true);
                }
                $imageName = str_replace(' ', '_', $image->getClientOriginalName());
                $image->move($destinationImagePath, $imageName);
                $imagePath = $relativeImagePath . $imageName;
            }

            $exercise = Exercise::create([
                'name' => $validated['name'],
                'exercise_category_id' => $request->input('exercise_category_id', null),
                'exercise_equipment_id' => $request->input('exercise_equipment_id', null),
                // 'training_level_id' => $request->input('training_level_id', null),
                'batch_id' => $request->input('batch_id', null),
                'batch_type' => $request->input('batch_type', null),
                // 'type' => $request->input('exercise_type', null),
                'type' => 'general_exercise',
                // 'instructions' => $request->input('instructions', null),
                // 'thumbnail' => $request->input('thumbnail', null),
                'video_url' => $videoPath ?? null,
                'image_url' => $imagePath ?? null,
                'user_level' => $request->input('user_level', null),
                'goal_id' => $request->input('goal_id', null),
                // 'belong_to_set' => $request->input('belong_to_set', null),
            ]);

            // Return a response
            return response()->json([
                'message' => 'Exercise created successfully',
                'exercise' => $exercise
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            // Return validation errors
            return response()->json([
                'error' => 'Validation error',
                'messages' => $validationException->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log the error message and stack trace
            // \Log::error('Error creating exercise: ' . $e->getMessage());
            // \Log::error($e);

            // Return a JSON response with the error message
            return response()->json(['error' => 'An error occurred while creating the exercise.', 'details' => $e->getMessage()], 500);
        }
    }
    public function fitinminstore(Request $request)
    {
        try {
            // Validate incoming request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'exercise_category_id' => 'required|integer',
                'belong_to_set' => 'required|integer',
                'user_level' => 'required|integer',
                'batch_id' => 'required|integer',
                // 'video' => 'nullable|file|mimes:mp4,mov,avi|max:20480', // Max 20MB
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 2MB
            ]);

            // Handle file uploads
            $videoPath = null;
            $imagePath = null;

            if ($request->hasFile('video')) {
                $video = $request->file('video');

                if ($request->exercise_type == 'general_exercise') {
                    $relativeVideoPath = 'exercises/general_exercise/videos/';
                } else {
                    $relativeVideoPath = 'exercises/videos/';
                }

                $destinationVideoPath = public_path($relativeVideoPath);

                if (!file_exists($destinationVideoPath)) {
                    mkdir($destinationVideoPath, 0755, true);
                    $videoName = str_replace(' ', '_', $video->getClientOriginalName());
                    $video->move($destinationVideoPath, $videoName);
                    $videoPath = $relativeVideoPath . $videoName;
                }
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                if ($request->exercise_type == 'general_exercise') {
                    $relativeImagePath = 'exercises/general_exercise/images/';
                } else {
                    $relativeImagePath = 'exercises/images/';
                }
                $destinationImagePath = public_path($relativeImagePath);
                if (!file_exists($destinationImagePath)) {
                    mkdir($destinationImagePath, 0755, true);
                }
                $imageName = str_replace(' ', '_', $image->getClientOriginalName());
                $image->move($destinationImagePath, $imageName);
                $imagePath = $relativeImagePath . $imageName;
            }

            $exercise = Exercise::create([
                'name' => $validated['name'],
                'exercise_category_id' => $request->input('exercise_category_id', null),
                // 'exercise_equipment_id' => $request->input('exercise_equipment_id', null),
                // 'training_level_id' => $request->input('training_level_id', null),
                'batch_id' => $request->input('batch_id', null),
                'batch_type' => $request->input('batch_type', null),
                // 'type' => $request->input('exercise_type', null),
                'type' => 'fit_in_min',
                // 'instructions' => $request->input('instructions', null),
                // 'thumbnail' => $request->input('thumbnail', null),
                'video_url' => $videoPath ?? null,
                'image_url' => $imagePath ?? null,
                'user_level' => $request->input('user_level', null),
                // 'goal_id' => $request->input('goal_id', null),
                'belong_to_set' => $request->input('belong_to_set', null),
            ]);
            // Return a response
            return response()->json([
                'message' => 'Exercise created successfully',
                'exercise' => $exercise
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            // Return validation errors
            return response()->json([
                'error' => 'Validation error',
                'messages' => $validationException->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log the error message and stack trace
            // \Log::error('Error creating exercise: ' . $e->getMessage());
            // \Log::error($e);

            // Return a JSON response with the error message
            return response()->json(['error' => 'An error occurred while creating the exercise.', 'details' => $e->getMessage()], 500);
        }
    }

}
