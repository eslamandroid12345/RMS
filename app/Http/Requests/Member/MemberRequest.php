<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [$this->member ? 'nullable' : 'required'  , 'string'],
            'email' => [$this->member ? 'nullable' : 'required' , Rule::unique('users' , 'email')->ignore($this->member)],
            'password' => [$this->member ? 'nullable' : 'required' , $this->password ? 'confirmed' : '' ],
            'image' => 'nullable',
            'phone_number' => ['nullable' , Rule::unique('users' , 'phone_number')->ignore($this->member)],
            'teams' => 'nullable|array',
            'permissions' => 'nullable|array',
            'role'=>'required',
        ];
    }
}
