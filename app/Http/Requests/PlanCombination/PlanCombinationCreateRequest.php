<?php

namespace App\Http\Requests\PlanCombination;

use Bpuig\Subby\Models\PlanCombination;
use Illuminate\Foundation\Http\FormRequest;

class PlanCombinationCreateRequest extends FormRequest
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
        return (new PlanCombination())->getRules();
    }
}
