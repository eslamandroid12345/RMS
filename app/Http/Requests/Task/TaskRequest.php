<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'project_id' => ['required' , Rule::exists('projects' , 'id')],
            'name' => 'required|max:255',
            'team_id'=>['required',Rule::exists('teams','id')],
            'description' => 'nullable' ,
            'deadline' => 'nullable|after:now',
            'members' => 'nullable|array',
            'members.*' => [Rule::exists('users' , 'id')]
        ];
    }
    public function messages():array
    {
        return [
            'name.required'=>'The Title Field is Required'
        ];
    }
}
