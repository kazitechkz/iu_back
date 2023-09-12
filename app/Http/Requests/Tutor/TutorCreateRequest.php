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
            "gender_id"=>"required|exists:genders",
            "phone"=>"required|max:255|unique:tutors.phone",
            "email"=>"required|email|unique:tutors,email",
            "iin"=>"required|iin|unique:tutors,iin",
            "birth_date"=>"required|date",
            "bio"=>"required",
            "experience"=>"required",
        ];
    }
}
