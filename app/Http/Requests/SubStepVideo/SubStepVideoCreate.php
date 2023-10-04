<?php

namespace App\Http\Requests\SubStepVideo;

use Illuminate\Foundation\Http\FormRequest;

class SubStepVideoCreate extends FormRequest
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
            'sub_step_id' => 'required|exists:sub_steps,id',
            'url' => 'required'
        ];
    }
}
