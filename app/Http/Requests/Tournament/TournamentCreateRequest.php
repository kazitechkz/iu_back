<?php

namespace App\Http\Requests\Tournament;

use Illuminate\Foundation\Http\FormRequest;

class TournamentCreateRequest extends FormRequest
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
            "subject_id"=>"required|exists:subjects,id",
            "title_ru"=>"required|max:255",
            "title_kk"=>"required|max:255",
            "title_en"=>"sometimes|nullable|max:255",
            "rule_ru"=>"required|max:20000",
            "rule_kk"=>"required|max:20000",
            "rule_en"=>"sometimes|nullable|max:20000",
            "description_ru"=>"required|max:20000",
            "description_kk"=>"required|max:20000",
            "description_en"=>"sometimes|nullable|max:20000",
            "price"=>"required|int|max:100000",
            "currency"=>"required|string|size:3",
            "status"=>"required",
            "start_at"=>"required",
            "end_at"=>"required",
        ];
    }
}
