<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubTaskRequest extends FormRequest
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
            'task_id' => ['required', Rule::exists('tasks' , 'id')],
            'name' => $this->id?'nullable':'required',
            'description' => 'nullable',
            'status' => 'nullable',
            'sort' => 'nullable|number'
        ];
    }
    public function messages():array
    {
        return [
            'name.required'=>'The Title Field is Required'
        ];
    }
}
