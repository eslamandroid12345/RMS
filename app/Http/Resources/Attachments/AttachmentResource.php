<?php

namespace App\Http\Resources\Attachments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'description'=>$this->description,
            'by'=>$this->user->name,
            'path'=>$this->path,
            'type'=>$this->type,
            'created_at'=>$this->created_at,
        ];
    }
}
