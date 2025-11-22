<?php

namespace App\Payments;

use App\Http\Controllers\Controller;
use App\Interfaces\Payments\PaymentGateways;
use Exception;
use Illuminate\Support\Facades\Log;

abstract  class PaymentServices extends Controller implements PaymentGateways
{

    public function pay(float $amount, array $data)
    {
        try {
            Log::info("Starting payment via " . static::class, ['amount' => $amount]);

            $response = $this->processPayment($amount, $data);

            Log::info("Payment Success", ['id' => $response->transactionId]);

            return $response;

        } catch (Exception $e) {
            Log::error("Payment Failed: " . $e->getMessage());
            return PaymentResponse::failure($e->getMessage());
        }
    }
    abstract protected function processPayment(float $amount, array $data);
}
