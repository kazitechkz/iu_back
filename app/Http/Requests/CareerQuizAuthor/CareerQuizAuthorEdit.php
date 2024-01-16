<?php

namespace App\Http\Requests\CareerQuizAuthor;

use Illuminate\Foundation\Http\FormRequest;

class CareerQuizAuthorEdit extends FormRequest
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
            'image_url'=>"required",
            'name'=>"required|max:255",
            'position_ru'=>"required|max:255",
            'position_kk'=>"required|max:255",
            'description_ru'=>"required",
            'description_kk'=>"required",
            'instagram_url'=>"sometimes|nullable|max:5000",
            'facebook_url'=>"sometimes|nullable|max:5000",
            'vk_url'=>"sometimes|nullable|max:5000",
            'linkedin_url'=>"sometimes|nullable|max:5000",
            'site'=>"sometimes|nullable|url|max:5000",
            'email'=>"sometimes|nullable|email",
            'phone'=>"sometimes|nullable|max:5000"
        ];
    }
}
