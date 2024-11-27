<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
            'name' => [$this->id ? 'nullable' : 'required', 'max:255'],
            'description' => $this->id ? 'nullable' : 'required',
            'ticket_id' => [$this->id ? 'nullable' : 'required', Rule::unique('projects', 'ticket_id')->ignore($this->id)],
            'customer_name' => $this->id ? 'nullable' : 'required',
            'image' => ['nullable', 'exclude', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'start_date' => $this->id ? 'nullable' : 'required',
            'dead_line' => 'nullable|after:start_date',
            'members' => 'nullable|array',
            'members.*' => [Rule::exists('users', 'id')],
            'link' => 'nullable',
            'link.link' => 'url',
        ];
    }
}
