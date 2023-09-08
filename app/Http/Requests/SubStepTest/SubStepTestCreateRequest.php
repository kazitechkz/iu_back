<?php

namespace App\Http\Requests\SubStepTest;

use Illuminate\Foundation\Http\FormRequest;

class SubStepTestCreateRequest extends FormRequest
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
            'sub_step_id' => 'required|exists:sub_steps,id',
            'locale_id' => 'required|exists:locales,id',
            'text' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'correct_answers' => 'required',
        ];
    }
}
