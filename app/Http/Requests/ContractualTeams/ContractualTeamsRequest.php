<?php

namespace App\Http\Requests\ContractualTeams;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContractualTeamsRequest extends FormRequest
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
            'team_id' => ['required',Rule::exists('teams', 'id'),],
            'member_count' => 'required|numeric',
        ];
    }
}
