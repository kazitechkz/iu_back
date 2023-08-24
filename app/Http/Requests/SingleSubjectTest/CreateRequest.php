<?php

namespace App\Http\Requests\SingleSubjectTest;

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
            'single_answer_questions_quantity' => 'sometimes|numeric|min:0',
            'contextual_questions_quantity' => 'sometimes|numeric|min:0',
            'multi_answer_questions_quantity' => 'sometimes|numeric|min:0',
            'allotted_time' => 'required|numeric|min:0|not_in:0',
            'subject_id' => 'required|exists:subjects,id'
        ];
    }

    public function attributes(): array
    {
        return [
            'single_answer_questions_quantity' => 'Кол-во вопросов с 1 ответом',
            'contextual_questions_quantity' => 'Кол-во контекстных вопросов',
            'multi_answer_questions_quantity' => 'Кол-во вопросов с несколькими ответами',
            'allotted_time' => 'Отведенное время (мин)',
            'subject_id' => 'Предмет'
        ];
    }
}
