<?php

namespace App\Http\Resources\Static;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateStaticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name"=> $this->name ,
            "average_rating"=> number_format($this->average_rating,2),
            "month"=> $this->month ,
            "month_name"=> Carbon::create(null,$this->month,1)->format('F') ,
            "year"=> $this->year ,
            "color"=> $this->color ,
        ];
    }
}
