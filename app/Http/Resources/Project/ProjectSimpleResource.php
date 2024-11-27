<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Attachments\AttachmentResource;
use App\Http\Resources\Events\EventResource;
use App\Http\Resources\Links\LinkResource;
use App\Http\Resources\Task\ProjectTaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectSimpleResource extends JsonResource
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
        ];
    }
}
