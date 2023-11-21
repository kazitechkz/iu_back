<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class NotificationCreateRequest extends FormRequest
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
            'type_id'=>"required|exists:notification_types,id",
            'class_id'=>"sometimes|nullable|exists:classroom_groups,id",
            'owner_id'=>"sometimes|nullable|exists:users,id",
            'users'=>"sometimes|nullable|array",
            'users.*'=>"sometimes|nullable|exists:users,id",
            'title'=>"required|max:255",
            'message'=>"required|max:5000"
        ];
    }
}
