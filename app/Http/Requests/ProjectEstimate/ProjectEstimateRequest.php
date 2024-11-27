<?php

namespace App\Http\Requests\ProjectEstimate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectEstimateRequest extends FormRequest
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

            'project_id' => ['required',Rule::unique('project_estimates', 'project_id')->ignore($this->route('project_estimate'))],
            'project_name' => 'required',
            'contractual_start_date' => 'required|date',
            'contractual_end_date' => 'required|date|after_or_equal:contractual_start_date',
            'actual_start_date' => 'required|date',
            'actual_end_date' => 'required|date|after_or_equal:actual_start_date',
            'project_type' => 'required|string',
            'project_status' => 'required|in:pending,in_progress,completed,canceled', // Assuming enum values for status
            'description' => 'required|string',
            'general_cost' => 'required|numeric|min:0',
            'profit_precentage' => 'required|numeric|min:0|max:100',
            'areeb_custom_note' => 'required|string',
            'scopes' => 'nullable|array',
            'scopes.*' => 'file|mimes:pdf,doc,docx,zip,jpeg,png|max:2048', // Validate each file in the array
        ];
    }
}
