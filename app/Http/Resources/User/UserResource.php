<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Role\PermissionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'phone_number' => $this->phone_number,
            'email'=>$this->email,
            'image' => $this->image,
            'current_status' => $this->current_status,
            'token' => $this->token(),
        ];
    }
}
