<?php

namespace App\Http\Requests\LessonSchedule;

use Illuminate\Foundation\Http\FormRequest;

class LessonScheduleUpdateRequest extends FormRequest
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
            'tutor_id' => 'required|exists:tutors,id',
            'start_at' => 'required',
            'end_at' => 'required',
            'price' => 'required|int|min:100|max:100000',
            'amount' => 'required|int|min:1|max:100',
        ];
    }
}
