<?php

namespace App\Http\Requests\SubStepContent;

use Illuminate\Foundation\Http\FormRequest;

class SubStepContentUpdateRequest extends FormRequest
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
            'text_ru'=>"required",
            'text_kk'=>"required",
            'sub_step_id'=>"required|exists:sub_steps,id",
        ];
    }
}
