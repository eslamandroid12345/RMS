<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Attachments\AttachmentResource;
use App\Http\Resources\Events\EventResource;
use App\Http\Resources\Links\LinkResource;
use App\Http\Resources\Task\ProjectTaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDetailsResource extends JsonResource
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
            'image' => $this->image,
            'name' => $this->name,
            'ticket_id' => $this->ticket_id,
            'created_by' => $this->creator->name,
            'start_date'=>$this->start_date,
            'dead_line'=>$this->dead_line,
            'tasks_progress'=>$this->tasksProgress,
            'customer_name' => $this->customer_name,
            'status' => $this->status,
            'members' => ProjectMemberResource::collection($this->members),
            'description' => $this->description,
            'tasks' => ProjectTaskResource::collection($this->tasks)  ,
            'attachments' => AttachmentResource::collection($this->attachments),
            'links' => LinkResource::collection($this->links),
            'events' => EventResource::collection($this->events),
        ];
    }
}
