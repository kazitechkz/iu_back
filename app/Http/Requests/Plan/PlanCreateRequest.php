<?php

namespace App\Http\Requests\Plan;

use Bpuig\Subby\Models\Plan;
use Illuminate\Foundation\Http\FormRequest;

class PlanCreateRequest extends FormRequest
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
        $rules = (new Plan())->getRules();
        $rules["commercial_group_id"] = "required";
        return $rules;
    }
}
