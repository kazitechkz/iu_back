<?php

namespace App\Http\Requests\CareerQuizAnswer;

use Illuminate\Foundation\Http\FormRequest;

class CareerQuizAnswerEdit extends FormRequest
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
            'quiz_id'=>"required|exists:career_quizzes,id",
            'title_ru'=>"required|max:255",
            'title_kk'=>"required|max:255",
            'title_en'=>"sometimes|nullable|max:255",
            'feature_id'=>"sometimes|nullable|exists:career_quiz_features,id",
            'value'=>"required|integer"
        ];
    }
}
