<?php

namespace App\Http\Resources\TimeSheet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'can_delete' => true,
            'time' => $this->time,
            'screenshots' => $this->images_count . ' ' . __('messages.Screenshots'),
            'activity' => __('messages.Active') . ' ' . $this->activity . '%',
        ];
    }
}
