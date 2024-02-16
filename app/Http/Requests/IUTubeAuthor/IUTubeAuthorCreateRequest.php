<?php

namespace App\Http\Requests\IUTubeAuthor;

use Illuminate\Foundation\Http\FormRequest;

class IUTubeAuthorCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"=>"required|max:500",
            "description"=>"required|max:50000",
            "instagram_url"=>"sometimes|nullable|url",
            "vk_url"=>"sometimes|nullable|url",
            "linkedin_url"=>"sometimes|nullable|url",
            "facebook_url"=>"sometimes|nullable|url",
            "tiktok_url"=>"sometimes|nullable|url",
            "phone"=>"sometimes|nullable",
            "email"=>"sometimes|nullable|email",
        ];
    }
}
