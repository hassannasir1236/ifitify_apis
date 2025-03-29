<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\GetExerciseVideosAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetExerciseVideosRequest;
use App\Http\Resources\VideoCollection;
use App\Models\Exercise;
use App\Models\ExerciseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GetExerciseVideosController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(
    //     GetExerciseVideosRequest $request,
    //     GetExerciseVideosAction $action
    // ) {
    //     $data = $request->validated();

    //     $videos =  $action->execute(
    //         $data['categories'],
    //         $data['equipments']
    //     );

    //     return [
    //         'videos' => new VideoCollection($videos)
    //     ];
    // }
    public function __invoke(
        GetExerciseVideosRequest $request,
        GetExerciseVideosAction $action
    ) {
        $data = $request->validated();
        // $videos =  $action->execute(
        //     $data['categories'],
        //     $data['equipments']
        // );

        // return [
        //     'videos' => new VideoCollection($videos)
        // ];
        // if (empty($data['equipments']) && empty($data['categories'])) {
        //     return response()->json([
        //         'videos' => array()
        //     ]);
        // }
         // $query = Exercise::where('goal_id', auth()->user()->goal_id)
        // ->where('user_level', auth()->user()->user_level_id)
        // ->where('type', 'general_exercise');
        $query = Exercise::whereIn('goal_id', explode(',', auth()->user()->goal_id))
        // ->whereIn('user_level', explode(',', auth()->user()->user_level_id))
        ->where('type', 'general_exercise');
        if (!empty($data['categories']) && is_array($data['categories'])) {
            $query->WhereIn('exercise_category_id', $data['categories']);
        }
        
        if (!empty($data['equipments']) && is_array($data['equipments'])) {
            $query->WhereIn('exercise_equipment_id', $data['equipments']);
        }
        
        $exercises = $query->get();    
        if ($exercises->isEmpty()) {
            return response()->json([
                'videos' => array()
            ], 200);
        }

        $response = [];
        foreach ($exercises as $exercise) {

            $response[] = [
                'id' => $exercise->id,
                'name' => $exercise->name,
                'category' => $exercise->exerciseCategory->title ?? null,
                'gif_url' => $exercise->image_url ? url($exercise->image_url) : null,
            ];
        }

        return response()->json([
            'videos' => $response
        ]);
    }
}
