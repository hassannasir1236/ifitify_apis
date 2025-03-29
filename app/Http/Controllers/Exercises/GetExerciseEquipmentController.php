<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\GetExerciseEquipmentsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExerciseEquipmentCollection;
use Illuminate\Http\Request;

class GetExerciseEquipmentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GetExerciseEquipmentsAction $action)
    {
        $equipments =  $action->execute();

        return response()->json( new ExerciseEquipmentCollection($equipments), 200);

    }
}
