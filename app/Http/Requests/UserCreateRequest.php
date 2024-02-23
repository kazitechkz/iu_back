<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function updated($propertyName)

    {

        $this->validateOnly($propertyName);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|max:255",
//            "username"=>"required|unique:users,username",
            "email" => "required|email|unique:users,email",
            "phone" => "required|unique:users,phone",
            "password" => "required|min:4|max:255"
        ];
    }
}
