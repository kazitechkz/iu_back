<?php

namespace App\Http\Requests\CareerQuizCoupon;

use Illuminate\Foundation\Http\FormRequest;

class CareerQuizCouponEdit extends FormRequest
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
            "user_id"=>"required",
            "order_id"=>"required",
            "career_quiz_id"=>"required|exists:career_quizzes,id",
            "career_group_id"=>"required|exists:career_quiz_groups,id",
        ];
    }
}
