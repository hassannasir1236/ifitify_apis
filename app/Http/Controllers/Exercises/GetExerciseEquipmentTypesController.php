<?php

namespace App\Http\Controllers\Exercises;

use App\Actions\Exercises\GetExerciseEquipmentsAction;
use App\Http\Controllers\Controller;

class GetExerciseEquipmentTypesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GetExerciseEquipmentsAction $action)
    {
        $equipments =  $action->execute();
        $data = $this->formatEquipmentTypes( $equipments);
        return response()->json($data, 200);
    }

    private function formatEquipmentTypes($equipments) : array{
        $exerciseEquipmentTypes = [];
        foreach ($equipments as $key=>$equipment) {
            $data =[];

            $data['id'] = $equipment->id;
            $data['name'] = str_replace('_', ' ', $equipment->equipment_type);

            $exerciseEquipmentTypes[$key] = $data;
        }

        $uniqueNames = [];
        $filteredArray = [];

        foreach ($exerciseEquipmentTypes as $item) {
            if (!in_array($item["name"], $uniqueNames)) {
                $uniqueNames[] = $item["name"];
                $filteredArray[] = $item;
            }
        }

        return $filteredArray;
    }
}
