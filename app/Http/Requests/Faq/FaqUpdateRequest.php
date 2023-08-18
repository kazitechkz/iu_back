<?php

namespace App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;

class FaqUpdateRequest extends FormRequest
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
            'question'=>"required|max:1000",
            'answer'=>"required|max:10000",
            'locale_id'=>"required|exists:locales,id"
        ];
    }
}
