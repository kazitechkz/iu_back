<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'subject_id' => 'required|exists:subjects,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'type_id' => 'required|exists:question_types,id',
            'locale_id' => 'required|exists:locales,id',
            'group_id' => 'sometimes|exists:groups,id',
            'text' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'correct_answers' => 'required',
            'prompt' => 'nullable|min:1',
            'explanation' => 'nullable|min:1'
        ];
    }
}
