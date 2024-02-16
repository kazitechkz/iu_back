<?php

namespace App\Http\Requests\IUTubeVideo;

use Illuminate\Foundation\Http\FormRequest;

class IUTubeVideoCreateRequest extends FormRequest
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
            "title"=>"required|max:500",
            "description"=>"sometimes|nullable|max:50000",
            "author_id"=>"required|exists:iutube_authors,id",
            "locale_id"=>"required|exists:locales,id",
            "subject_id"=>"required|exists:subjects,id",
            "step_id"=>"sometimes|nullable|exists:steps,id",
            "sub_step_id"=>"sometimes|nullable|exists:sub_steps,id",
            "video_url"=>"required|url",
            "price"=>"required|integer|min:0|max:10000",
        ];
    }
}
