<?php

namespace App\Http\Resources\Report;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'review_text'=>$this->review_text,
            'author_name'=>$this->author?->name,
            'team'=>$this->author?->team?->first()?->name,
            'rating'=>intval(number_format($this->rating,2)),
            'created_at'=>$this->created_at,
        ];
    }
}
