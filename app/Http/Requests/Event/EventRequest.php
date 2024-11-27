<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
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
            'project_id' => ['required' , Rule::exists('projects' , 'id')] ,
            'name' => 'required|max:255',
            'description' => 'nullable',
            'external_link' => 'nullable',
            'status' => 'nullable'
        ];
    }
}
