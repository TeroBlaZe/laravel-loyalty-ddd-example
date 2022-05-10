<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoyaltyAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'phone' => ['required', 'max:255', 'regex:/^\+[1-9]{1}[0-9]{1,14}$/i'],
            'card' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'email_notification' => ['required', 'boolean'],
            'phone_notification' => ['required', 'boolean'],
            'active' => ['required', 'boolean'],
        ];
    }
}
