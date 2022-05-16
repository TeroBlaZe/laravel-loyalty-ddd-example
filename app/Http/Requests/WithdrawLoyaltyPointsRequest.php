<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawLoyaltyPointsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_type' => ['required'],
            'account_id' => ['required'],
            'points_amount' => ['required', 'numeric', 'min:0'],
            'description' => ['required'],
        ];
    }
}
