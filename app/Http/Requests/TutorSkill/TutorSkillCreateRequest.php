<?php

namespace App\Http\Requests\TutorSkill;

use Illuminate\Foundation\Http\FormRequest;

class TutorSkillCreateRequest extends FormRequest
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
            "tutor_id"=>"required|exists:tutors,id",
            "category_id"=>"required|exists:categories,id",
            "subject_id"=>"required|exists:subjects,id"
        ];
    }
}
