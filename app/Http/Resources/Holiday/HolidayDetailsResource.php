<?php

namespace App\Http\Resources\Holiday;

use App\Http\Enums\HolidayStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HolidayDetailsResource extends JsonResource
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
            'is_right' => $this->isRight,
            'can_response' => $this->when($this->parent_id == null , $this->canResponse),
            'user_name' => $this->whenNotNull($this->user?->name),
            'user_team' => $this->whenNotNull($this->user?->team?->first()?->t('name')),
            'text' => $this->whenNotNull($this->text),
            'responses' => HolidayDetailsResource::collection($this->whenLoaded('assignedResponses'))
        ];
    }
}
