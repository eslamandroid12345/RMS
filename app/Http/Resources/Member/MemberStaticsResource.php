<?php

namespace App\Http\Resources\Member;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberStaticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'month'=>$this->month,
                'month_name'=>Carbon::create(null,$this->month,1)->format('F'),
                'year'=>$this->year,
                'average_rating'=>$this->average_rating,
        ];
    }
}
