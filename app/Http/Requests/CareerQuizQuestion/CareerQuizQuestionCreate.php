<?php

namespace App\Http\Requests\CareerQuizQuestion;

use Illuminate\Foundation\Http\FormRequest;

class CareerQuizQuestionCreate extends FormRequest
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
            'feature_id'=>"required|exists:career_quiz_features,id",
            'question_ru'=>"required",
            'question_kk'=>"required",
        ];
    }
}
