<?php

namespace App\Payments;

use Illuminate\Support\Facades\Auth;

class StripePaymentServices extends PaymentServices
{
    protected function processPayment(float $amount, array $data): PaymentResponse
    {
        $user = Auth::user();

        $charge = $user->charge(
            $amount * 100, $data['payment_method_id'],
            ['return_url' => 'http://127.0.0.1:8000/api/payment/status',
            'confirm' => true,] );

        return PaymentResponse::success($charge->id, $charge->asStripePaymentIntent()->toArray());
    }
}
