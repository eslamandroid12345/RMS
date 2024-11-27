<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InfoSettingsRequest extends FormRequest
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
            'name' => [$this->id ? 'nullable' : 'required'  , 'string'],
            'image' => 'nullable',
            'email' => [$this->id ? 'nullable' : 'required' , Rule::unique('users' , 'email')->ignore(auth('api')->id())],
            'phone_number' => ['nullable' , Rule::unique('users' , 'phone_number')->ignore(auth('api')->id())],
            'current_status' => 'nullable'
        ];
    }
}
