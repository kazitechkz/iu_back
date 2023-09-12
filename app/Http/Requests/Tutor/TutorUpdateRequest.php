<?php

namespace App\Http\Requests\Tutor;

use Illuminate\Foundation\Http\FormRequest;

class TutorUpdateRequest extends FormRequest
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
    public function rules($id = 0): array
    {
        if($id == 0){
            $id = $this->get("tutor_id");
        }
        return [
            "tutor_id"=>"required|exists:tutors,id",
            "gender_id"=>"required|exists:genders,id",
            "phone"=>"required|max:255|unique:tutors,phone,".$id,
            "email"=>"required|email|unique:tutors,email,".$id,
            "iin"=>"required|unique:tutors,iin,".$id,
            "birth_date"=>"required|date",
            "bio"=>"required",
            "experience"=>"required",
        ];
    }
}
