<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositLoyaltyPointsRequest extends FormRequest
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
            'loyalty_points_rule' => ['required'],
            'description' => ['required', 'max:255'],
            'payment_id' => ['required'],
            'payment_amount' => ['required', 'numeric', 'min:0'],
            'payment_time' => ['required'],
        ];
    }
}
