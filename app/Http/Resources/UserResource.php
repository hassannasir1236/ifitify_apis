<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\Utils\AvatarUtils;
use Carbon\Carbon;
use App\Models\GoalLevel;
use App\Models\TrainingLevel;
class UserResource extends JsonResource
{
    use AvatarUtils;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $goalIds = is_array($this->goal_id) ? $this->goal_id : explode(',', $this->goal_id); // Handle array or comma-separated
        // $trainingLevelIds = GoalLevel::whereIn('goal_id', $goalIds)->pluck('training_level_id')->toArray();

        // // Fetch all training level data
        // $trainingLevels = TrainingLevel::whereIn('id', $trainingLevelIds)->get();
        $goalIds = is_array($this->goal_id) ? $this->goal_id : explode(',', $this->goal_id);

        // Fetch GoalLevel records based on goal_id
        $goalLevels = GoalLevel::whereIn('goal_id', $goalIds)->get();
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'country_code' => $this->country_code,
            'is_admin' => $this->is_admin,
            'weight' => (string) $this->start_weight,
            'weight_metric' => $this->start_weight_unit,
            'height' => (string) $this->start_height,
            'height_metric' => $this->start_height_unit,
            'date_of_birth' => Carbon::parse($this->date_of_birth)->format('m-d-Y'),
            'age' => Carbon::parse($this->date_of_birth)->age,
            // 'goal' => [
            //     'id' => $this->goal->id,
            //     'title' => $this->goal->title
            // ],
            'goal' => $this->goals()->map(function ($goal) {
                return [
                    'id' => $goal->id,
                    'title' => $goal->title,
                ];
            }),

            // 'userLevel' => [
            //     'id' => $this->userLevel->id,
            //     'title' => $this->userLevel->title
            // ],
            'userLevel' => $this->userLevels()->map(function ($userLevel) {
                return [
                    'id' => $userLevel->id,
                    'title' => $userLevel->title,
                ];
            }),
            'trainingLevels' => new GoalLevelCollection($goalLevels),
            'profile_image' => $this->getAvatarUrl($this->avatar),
            'before_progress_image' => $this->getAvatarUrl($this->metrics->previous_image_url ?? null),
            'after_progress_image' => $this->getAvatarUrl($this->metrics->progress_image_url ?? null),
        ];
    }

}
