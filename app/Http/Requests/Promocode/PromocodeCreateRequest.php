<?php

namespace App\Http\Requests\Promocode;

use Illuminate\Foundation\Http\FormRequest;

class PromocodeCreateRequest extends FormRequest
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
            "points"=>"required|int|min:1|max:10000",
            "count"=>"required|int|min:1|max:1000",
            "usages"=>"required|int|min:1|max:1000",
            "expiration_date"=>"required"
        ];
    }
}
