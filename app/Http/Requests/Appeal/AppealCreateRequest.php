<?php

namespace App\Http\Requests\Appeal;

use Illuminate\Foundation\Http\FormRequest;

class AppealCreateRequest extends FormRequest
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
            "question_id"=>"required|exists:questions,id",
            "type_id"=>"required|exists:appeal_types,id",
            "message"=>"sometimes|max:255",
            "status"=>"required|in:-1,0,1"
        ];
    }
}
