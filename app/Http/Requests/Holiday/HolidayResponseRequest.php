<?php

namespace App\Http\Requests\Holiday;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HolidayResponseRequest extends FormRequest
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
            'parent_id' => ['required',Rule::exists('holidays','id')->whereNull('parent_id')] ,
            'text' => ['required', 'string'],
            'status' => ['nullable', Rule::in(['PENDING', 'APPROVED', 'REJECTED'])],
            'assignees' => ['required', 'array'],
            'assignees.*' => ['required', Rule::exists('users', 'id')],
        ];
    }
}
