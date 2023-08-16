<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title_kk' => 'required',
            'title_ru' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'subject_id' => 'Предмет',
            'title_kk' => 'Наименование на каз',
            'title_ru' => 'Наименование на рус'
        ];
    }
}
