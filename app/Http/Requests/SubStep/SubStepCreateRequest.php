<?php

namespace App\Http\Requests\SubStep;

use Illuminate\Foundation\Http\FormRequest;

class SubStepCreateRequest extends FormRequest
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
            'title_ru'=>"required|max:255",
            'title_kk'=>"required|max:255",
            'title_en'=>"max:255",
            'step_id'=>"required|exists:steps,id",
            'sub_category_id'=>"exists:sub_categories,id",
            'level'=>"required|min:0",
        ];
    }
}
