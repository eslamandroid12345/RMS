<?php

namespace App\Http\Resources\Holiday;

use App\Http\Enums\HolidayStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HolidayGeneralResource extends JsonResource
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
            'user_name' => $this->whenNotNull($this->user?->name),
            'user_team' => $this->whenNotNull($this->user?->team?->first()?->t('name')),
            'text' => $this->whenNotNull($this->text),
        ];
    }
}
