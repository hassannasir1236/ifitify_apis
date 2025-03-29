<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\CreateExerciseVideoAction;
use App\Http\Controllers\Controller;
use App\Repositories\ExerciseRepository;
use Illuminate\Http\Request;

class CreateExerciseVideoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        CreateExerciseVideoAction $action,
        ExerciseRepository $exerciseRepository
    ) {
        $request->validate([
            'exercise_id' => 'required|numeric|exists:exercises,id',
            'exercise_category_id' => 'required|numeric|exists:exercise_categories,id',
            'exercise_equipment_id' => 'required|numeric|exists:exercise_equipments,id',
            'training_level_id' => 'required|array',
            'video' => 'required|mimes:mp4,gif,avi,mov',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,base64|max:20000',
            'instructions' => 'required|string',
        ]);

       

        $data = [
            'exercise_id' => $request->exercise_id,
            'exercise_category_id' => $request->exercise_category_id,
            'training_level_id' => json_encode(array_map('intval', $request->training_level_id)),
            'exercise_equipment_id' => $request->exercise_equipment_id,
            'video_url' => $this->saveFile($request, $exerciseRepository, 'video'),
            'image_url' => $this->saveFile($request, $exerciseRepository, 'image'),
            'instructions' => $request->instructions
        ];

        $action->execute($data);

        return [
            'message' => 'exercise video created'
        ];
    }

    private function saveFile($request, $exerciseRepository, $fileType)
    {
        $exercise = $exerciseRepository->getExerciseById($request->exercise_id);

        $file = $request->file($fileType);
        $name = str_replace(' ', '_', $exercise->name) .'.'. $file->guessExtension();
        $destinationPath = public_path('exercises');
        $file->move($destinationPath, $name);
        $url =  'exercises/' . $name;

        return $url ;
    }
}
