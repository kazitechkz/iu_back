<?php

namespace App\Http\Requests\AnnouncementGroup;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementGroupUpdateRequest extends FormRequest
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
            'title_en'=>"sometimes|nullable|max:255",
            'thumbnail'=>"required",
            'start_date'=>"sometimes|nullable|date|before:end_date",
            'end_date'=>"sometimes|nullable|date|after:start_date",
            'order'=>"required|integer|min:0"
        ];
    }
}
