<?php

namespace App\Http\Requests\Information;

use Illuminate\Foundation\Http\FormRequest;

class InformationCreateRequest extends FormRequest
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
            'author_id'=>"required|exists:information_authors,id",
            'category_id'=>"required|exists:information_categories,id",
            'image_url'=>"required",
            'seo_title'=>"required|max:5000",
            'seo_description'=>"required",
            'seo_keywords'=>"required",
            'title_ru'=>"required|max:2000",
            'title_kk'=>"required|max:2000",
            'description_ru'=>"required",
            'description_kk'=>"required",
            'published_at'=>"required"
        ];
    }
}
