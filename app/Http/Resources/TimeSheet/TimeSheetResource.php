<?php

namespace App\Http\Resources\TimeSheet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeSheetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'project_image' => $this->project?->image,
            'project_name' => $this->project?->name,
            'activity' => intval($this->children_avg_activity).'%',
            'idle' => intval($this->children_avg_idle).'%',
            'duration' => $this->formatedDuration,
            'time' => $this->time,
        ];
    }
}
