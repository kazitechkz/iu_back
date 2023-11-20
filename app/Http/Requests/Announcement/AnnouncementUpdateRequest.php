<?php

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementUpdateRequest extends FormRequest
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
            'type_id'=>"required|exists:announcement_types,id",
            'group_id'=>"required|exists:announcement_groups,id",
            'background'=>"required|exists:files,id",
            'title'=>"required|max:255",
            'sub_title'=>"required|max:500",
            'description'=>"sometimes|nullable|max:10000",
            'time_in_sec'=>"required|integer|min:5|max:60",
            'url_text'=>"sometimes|nullable|max:255",
            'url'=>"sometimes|nullable|max:255|url",
        ];
    }
}
