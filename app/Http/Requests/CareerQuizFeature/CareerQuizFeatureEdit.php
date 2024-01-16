<?php

namespace App\Http\Requests\CareerQuizFeature;

use Illuminate\Foundation\Http\FormRequest;

class CareerQuizFeatureEdit extends FormRequest
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
            'image_url'=>"required",
            'quiz_id'=>"required|exists:career_quizzes,id",
            'title_ru'=>"required|max:255",
            'title_kk'=>"required|max:255",
            'title_en'=>"sometimes|nullable|max:255",
            'description_ru'=>"required",
            'description_kk'=>"required",
            'description_en'=>"sometimes|nullable",
            'activity_ru'=>"required",
            'activity_kk'=>"required",
            'prospect_ru'=>"required",
            'prospect_kk'=>"required",
            'meaning_ru'=>"required",
            'meaning_kk'=>"required",
        ];
    }
}
