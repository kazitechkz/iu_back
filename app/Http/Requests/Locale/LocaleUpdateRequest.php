<?php

namespace App\Http\Requests\Locale;

use Illuminate\Foundation\Http\FormRequest;

class LocaleUpdateRequest extends FormRequest
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
    public function rules($id = 0): array
    {
        if($id == 0){
            $id = $this->get("locale_id");
        }
        return [
            "title"=>"required|max:255",
            "code"=>"required|unique:locales,code,".$id."|max:100",
        ];
    }
}
