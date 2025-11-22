<?php

namespace App\Payments;

class PaymentResponse
{
    public bool $success;
    public string $message;
    public ?string $transactionId;
    public array $data;

    public function __construct(bool $success, string $message, ?string $transactionId = null, array $data = [])
    {
        $this->success = $success;
        $this->message = $message;
        $this->transactionId = $transactionId;
        $this->data = $data;
    }

    // دوال مساعدة
    public static function success($transactionId, $data = [])
    {
        return new self(true, 'Payment Successful', $transactionId, $data);
    }

    public static function failure($message)
    {
        return new self(false, $message);
    }
}
