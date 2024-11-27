<?php

namespace App\Http\Resources\ProjectEstimate;

use App\Http\Resources\Attachments\AttachmentResource;
use App\Http\Resources\Events\EventResource;
use App\Http\Resources\Links\LinkResource;
use App\Http\Resources\Task\ProjectTaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectEstimateResource extends JsonResource
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
            'user' => $this->user->name,
            'project_id' => $this->project_id,
            'project_name' => $this->project_name,
            'contractual_start_date' => $this->contractual_start_date,
            'contractual_end_date' => $this->contractual_end_date,
            'actual_start_date' => $this->actual_start_date,
            'actual_end_date' => $this->actual_end_date,
            'project_type' => $this->project_type,
            'project_status' => $this->project_status,
            'description' => $this->description,
            'areeb_custom_note' => $this->areeb_custom_note,
            'general_cost' => $this->general_cost,
            'profit_precentage' => $this->profit_precentage,
            'scopes' => ProjectEstimateScopeResource::collection($this->scopes),
        ];
    }
}
