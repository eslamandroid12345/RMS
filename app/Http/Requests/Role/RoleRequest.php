<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['required' , 'max:255' , Rule::unique('roles' , 'name')->ignore($this->role)],
            'display_name' => 'required:max:255',
            'description' => 'nullable',
            'permissions' => 'nullable|array',
            'permissions.*' => [Rule::exists('permissions' , 'id')]
        ];
    }
}
