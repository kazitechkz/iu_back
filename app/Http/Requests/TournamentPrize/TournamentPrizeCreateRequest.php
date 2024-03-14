<?php

namespace App\Http\Requests\TournamentPrize;

use Illuminate\Foundation\Http\FormRequest;

class TournamentPrizeCreateRequest extends FormRequest
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
            'title_ru'=>"required|max:255",
            'title_kk'=>"required|max:255",
            'title_en'=>"max:255",
            'tournament_id'=>"required|exists:tournaments,id",
        ];
    }
}
