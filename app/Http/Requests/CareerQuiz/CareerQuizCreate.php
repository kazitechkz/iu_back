<?php

namespace App\Http\Requests\CareerQuiz;

use App\Services\CareerQuizService;
use Illuminate\Foundation\Http\FormRequest;

class CareerQuizCreate extends FormRequest
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
            'group_id'=>"required|exists:career_quiz_groups,id",
            'title_ru'=>"required|max:255",
            'title_kk'=>"required|max:255",
            'title_en'=>"sometimes|nullable|max:255",
            'description_ru'=>"required",
            'description_kk'=>"required",
            'rule_ru'=>"required",
            'rule_kk'=>"required",
            'price'=>"required|min:0|max:1000000",
            'currency'=>"required",
            "authors"=>"sometimes|nullable",
            "authors.*"=>"exists:career_quiz_authors,id",
            "code"=>"required|in_array:['ONE_ANSWER','DRAG_DROP']"
        ];
    }
}
