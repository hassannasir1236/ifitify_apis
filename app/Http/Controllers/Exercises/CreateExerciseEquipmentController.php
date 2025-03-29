<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\CreateExerciseEquipmentAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateExerciseEquipmentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request , CreateExerciseEquipmentAction $action)
    {
        $request->validate([
            'name' => 'required|string',
            'equipment_type' => 'required|string'
        ]);

        $data = [
            'name' => $request->name,
            'equipment_type' => $request->equipment_type
        ];

        $action->execute($data);

        return [
            'message' => 'exercise equipment created'
        ];
    }
}
