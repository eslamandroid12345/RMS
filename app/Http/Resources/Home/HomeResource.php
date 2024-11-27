<?php

namespace App\Http\Resources\Home;

use App\Http\Resources\Report\ReportResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>auth()->user()->name,
            'email'=>auth()->user()->email,
            'users'=>$this->users->count(),
            'reports' => $this->reports->count(),
            'receivedReports' => $this->receivedReports,
            'viewedReports' => $this->viewedReports,
            'recentReports' => ReportResource::collection($this->recentReports),
            'teamStatus' => $this->teamStatus
        ];
    }
}
