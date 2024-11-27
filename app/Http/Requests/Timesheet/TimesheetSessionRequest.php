<?php

namespace App\Http\Requests\Timesheet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TimesheetSessionRequest extends FormRequest
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
            'parent_id' => ['required', Rule::exists('time_sheets', 'id')],
            'from' => ['required', 'date_format:Y-m-d H:i:s'],
            'to' => ['required', 'date_format:Y-m-d H:i:s'],
            'activity' => ['required', 'numeric'],
            'idle' => ['required', 'numeric'],
            'screenshots' => ['nullable', 'array'],
            'screenshots.*' => ['required', 'image'],
        ];
    }
}
