<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Project\ProjectSimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'project_id' => $this->project?->id,
            'project_name' => $this->project?->name,
            'project_image' => $this->project?->image,
            'description'=>$this->description,
            'team_id' => $this->team_id,
            'team_name' => $this->team?->name,
            'deadline' => $this->deadline,
            'progress' => $this->progress(),
            'status' => $this->status,
            'members' => MemberTaskResource::collection($this->members),
        ];
    }
}
