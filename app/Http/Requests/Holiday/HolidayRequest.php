<?php

namespace App\Http\Requests\Holiday;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HolidayRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'text' => ['required', 'string'],
            'type' => ['required', Rule::in(['DAY', 'PERMISSION', 'REMOTE', 'OTHER'])],
            'assignees' => ['required', 'array'],
            'assignees.*' => ['required', Rule::exists('users', 'id')],
        ];
    }
}
