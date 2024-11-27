<?php

namespace App\Http\Resources\Teams;

use App\Http\Resources\Member\MemberResource;
use App\Http\Resources\Member\MembersResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'icon' => $this->icon,
            'members'=>MembersResource::collection($this->members)
        ];
    }
}
