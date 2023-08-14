<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            $id = $this->get("user_id");
        }
        return [
            "name"=>"required|max:255",
            "username"=>"required|unique:users,username," . $id . "|max:255",
            "email"=>"required|email|unique:users,email," . $id . "|max:255",
            "phone"=>"required|unique:users,phone,". $id ."|max:255",
            "password"=>"nullable|confirmed|min:4|max:255"
        ];
    }
}
