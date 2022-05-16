<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelLoyaltyPointsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cancellation_reason' => ['required', 'max:255'],
            'transaction_id' => ['required', 'numeric', 'min:1'],
        ];
    }
}
