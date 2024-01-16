<?php

namespace App\Http\Requests\CareerQuizGroup;

use Illuminate\Foundation\Http\FormRequest;

class CareerQuizGroupCreate extends FormRequest
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
            'title_ru'=>"required|max:255",
            'title_kk'=>"required|max:255",
            'title_en'=>"sometimes|nullable|max:255",
            'description_ru'=>"required",
            'description_kk'=>"required",
            'email'=>"sometimes|nullable|email",
            'phone'=>"sometimes|nullable|max:5000",
            'address'=>"sometimes|nullable",
            'price'=>"integer|min:0|max:1000000",
            'currency'=>"required|max:10"
        ];
    }
}
