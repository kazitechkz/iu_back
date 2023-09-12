<?php

namespace App\Http\Requests\Tutor;

use Illuminate\Foundation\Http\FormRequest;

class TutorCreateRequest extends FormRequest
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
            "user_id"=>"required|exists:users,id",
            "gender_id"=>"required|exists:genders,id",
            "phone"=>"required|max:255|unique:tutors,phone",
            "email"=>"required|email|unique:tutors,email",
            "iin"=>"required|unique:tutors,iin|size:12",
            "birth_date"=>"required|date",
            "bio"=>"required",
            "experience"=>"required",
            "subject_id"=>"required|array|min:1",
            "category_id"=>"required|array|min:1",
        ];
    }
}
