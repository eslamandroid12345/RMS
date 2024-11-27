<?php

namespace App\Http\Resources\Holiday;

use App\Http\Enums\HolidayStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HolidayResource extends JsonResource
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
            'title' => $this->whenNotNull($this->title),
            'created_at' => $this->whenNotNull($this->createdAtFormat),
            'status' => HolidayStatus::from($this->status)->t(),
        ];
    }
}
