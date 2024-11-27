<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ToDoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total_tasks'=>$this->tasksCount,
            'hold_tasks'=>$this->holdTasks,
            'in_progress'=>$this->inProgressTasks,
            'done_tasks'=>$this->finishedTasks,
            'tasks'=>TaskResource::collection($this->toDo),
        ];
    }
}
