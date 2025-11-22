<?php

namespace App\Factories;


// use App\Services\Payment\PaymobPaymentService; // لما تعملها
use App\Payments\StripePaymentServices;
use Exception;

class PaymentFactory
{
    public static function create(string $type)
    {
        return match ($type) {
            'stripe' => new StripePaymentServices(),
            default => throw new Exception("Payment method [$type] is not supported."),
        };
    }
}
