<?php

namespace App\Http\Requests\Step;

use Illuminate\Foundation\Http\FormRequest;

class StepUpdateRequest extends FormRequest
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
    public function rules($level_id = 0): array
    {
        if($level_id == 0){
            $level_id = $this->get("level_id");
        }
        return [
            'title_ru'=>"required|max:255",
            'title_kk'=>"required|max:255",
            'title_en'=>"max:255",
            'subject_id'=>"required|exists:subjects,id",
            'category_id'=>"required|exists:categories,id",
            'plan_id'=>"required|exists:plans,id",
            'level'=>"required|min:1|unique:steps,level,".$level_id,
        ];
    }
}
