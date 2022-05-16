<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoyaltyAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => ['required', 'max:255'],
            'card' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'email_notification' => ['required', 'boolean'],
            'phone_notification' => ['required', 'boolean'],
            'active' => ['required', 'boolean'],
        ];
    }
}
