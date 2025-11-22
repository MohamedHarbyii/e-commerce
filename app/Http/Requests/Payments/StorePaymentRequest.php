<?php
namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
public function authorize()
{
return true;
}

public function rules()
{
return [
'amount' => ['required', 'numeric', 'min:1'],
'payment_method' => ['required', 'string', 'in:stripe,paymob'],
'payment_method_id' => ['required_if:payment_method,stripe', 'string', 'nullable'],
];
}

public function messages()
{
return [
'amount.required' => 'The amount is required.',
'amount.min' => 'The amount must be at least 1.',
'payment_method.in' => 'The selected payment method is invalid.',
'payment_method_id.required_if' => 'Payment method ID is required for Stripe.',
];
}
}
