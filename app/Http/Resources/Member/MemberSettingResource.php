<?php

namespace App\Http\Resources\Member;

use App\Http\Resources\Report\ReportResource;
use App\Http\Resources\Role\PermissionResource;
use App\Http\Resources\Role\PermissionSettingResource;
use App\Http\Resources\Role\RoleDetailsResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Role\RolesResource;
use App\Http\Resources\Teams\TeamResource;
use App\Http\Resources\Teams\TeamsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberSettingResource extends JsonResource
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
            'name' => $this->name,
            'email'=>$this->email,
            'team'=>TeamsResource::make($this->team()?->first()),
            'phone_number'=>$this->phone_number ,
            'current_status'=>$this->current_status,
            'statics'=>$this->statics,
            'image'=>$this->image,
            'rate'=>$this->rate??0,
            'total_reports'=>$this->reports->count(),
            'to_do'=>$this->tasksCount,
            'waiting_reports'=>$this->waiting_reports,
            'viewed_reports'=>$this->viewed_reports,
            'roles'=>RoleResource::make($this->roles?->first()),
            'permissions'=>PermissionSettingResource::collection($this->permissions),
            'recent_reports'=>ReportResource::collection($this->reports),
        ];
    }
}
