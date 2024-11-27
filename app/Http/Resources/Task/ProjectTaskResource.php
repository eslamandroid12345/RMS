<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectTaskResource extends JsonResource
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
            'project_id' => $this->project->id,
            'description' => $this->description,
            'team_id' => $this->team_id,
            'deadline_date' =>$this->deadline!=null?preg_split('/ +/', $this->deadline)[0]:null ,
            'deadline_time' =>$this->deadline!=null?preg_split('/ +/', $this->deadline)[1]:null,
            'status' => $this->status,
            'finished'=>$this->finished,
            'subTasks' => ProjectTaskResource::collection($this->subTasks()->orderBy('sort')->get()),
            'members' => MemberTaskResource::collection($this->members),

        ];
    }
}
