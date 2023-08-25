<?php

namespace App\Http\Requests\SubTournament;

use Illuminate\Foundation\Http\FormRequest;

class SubTournamentUpdateRequest extends FormRequest
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
            'tournament_id' => 'required|exists:tournaments,id',
            'step_id' => 'required|exists:tournament_steps,id',
            'single_question_quantity' => 'required|min:0|max:100',
            'multiple_question_quantity' => 'required|min:0|max:100',
            'context_question_quantity' => 'required|min:0|max:100',
            'time' => 'required|min:0|max:1000',
            'start_at' => 'required',
            'end_at' => 'required'
        ];
    }
}
