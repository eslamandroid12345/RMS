<?php

namespace App\Http\Resources\Report;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'report_text'=>$this->report_text,
            'reciver_name'=>$this->reciver?->name,
            'author_name'=>$this->author?->name,
            'team'=>$this->author?->team?->first()?->name,
            'status'=>$this->status,
            'rating'=>intval(number_format($this->rating,2)),
            'created_at'=>$this->created_at,
            'can_response'=>$this->canResponse,
            'reviews' => ReviewResource::collection($this->reviews),
        ];
    }
}
