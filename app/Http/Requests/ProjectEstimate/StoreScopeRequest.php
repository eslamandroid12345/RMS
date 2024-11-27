<?php

namespace App\Http\Requests\ProjectEstimate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreScopeRequest extends FormRequest
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

            'image' => 'required|file|mimes:pdf,doc,docx,zip,jpeg,png|max:2048', // Validate each file in the array
        ];
    }
}
