<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuickWorkout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkoutsController extends Controller
{
   public function createQuickWorkout(Request $request){

       $validatedData = $request->validate([
           'level' => 'required|string',
           'name' => 'required|string',
           'category' => 'required|string',
           'set' => 'required|integer',
           'preparation_duration' => 'required|integer',
           'rest_between_sets' => 'required|integer',
           'rest_between_exercises' => 'required|integer',
           'exercises_duration' => 'required|integer',
           'workout_duration' => 'required|integer',
           'video' => 'required|file|mimetypes:video/mp4,video/mov,video/avi,image/gif',
           'gif' => 'required|image|mimes:jpeg,png,jpg,gif',
       ]);

       // Handle the video file upload
       if ($request->hasFile('video')) {
           $video = $request->file('video');
           $videoName = uniqid() . '_' . Str::slug($request->name) . '.' . $video->guessExtension();
           $videoDestination = public_path('quickworkouts/videos');
           $video->move($videoDestination, $videoName);
           $validatedData['video_url'] = config('app.url') . '/' .'quickworkouts/videos/' . $videoName; // Save video URL
       }

       // Handle the image (GIF) file upload
       if ($request->hasFile('gif')) {
           $image = $request->file('gif');
           $imageName = uniqid() . '_' . Str::slug($request->name) . '.' . $image->guessExtension();
           $imageDestination = public_path('quickworkouts/gifs');
           $image->move($imageDestination, $imageName);
           $validatedData['gif_url'] = config('app.url') . '/' .'quickworkouts/gifs/' . $imageName; // Save GIF URL
       }

       // Set custom_workout_id with UUID
       $validatedData['custom_workout_id'] = Str::uuid();

       // Create the QuickWorkout record
       $quickWorkout = QuickWorkout::create($validatedData);

       // Return a success response
       return response()->json([
           'message' => 'Quick workout created successfully',
           'data' => $quickWorkout,
       ], 201);

   }
}
