<?php

namespace App\Http\Requests\InformationCategory;

use Illuminate\Foundation\Http\FormRequest;

class InformationCategoryCreateRequest extends FormRequest
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
            "title_ru"=>"required|max:5000",
            "title_kk"=>"required|max:5000",
        ];
    }
}
