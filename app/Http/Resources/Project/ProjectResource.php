<?php

namespace App\Http\Resources\Project;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'image' => $this->image,
            'progress'=>$this->progress(),
            'status' => $this->status,
            'ticket_id' => $this->ticket_id,
            'start_date' => $this->start_date,
            'dead_line' => $this->dead_line,
            'days_left' => $this->dead_line ? Carbon::today()->isAfter($this->dead_line)  ? __('dashboard.Overdue By').Carbon::make($this->dead_line)->diffInDays(Carbon::today()) .__('dashboard.Days') : Carbon::make($this->dead_line)->diffInDays(Carbon::today()) .__('dashboard.Days Left'): null,
            'members' => ProjectMemberResource::collection($this->members),
            'linksCount' =>$this->linksCount,
            'attachmentsCount' =>$this->attachmentsCount,
            'eventsCount' => $this->eventsCount,
        ];
    }
}
