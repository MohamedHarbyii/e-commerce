<?php
namespace App\Http\Controllers\Payments;

// 1. استدعاء الـ Request الجديد

use App\Factories\PaymentFactory;
use App\Http\Requests\Payments\StorePaymentRequest;
use Exception;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{
public function store(StorePaymentRequest $request)
{
    try {
        $gateway = PaymentFactory::create($request->payment_method);

        $result = $gateway->pay($request->amount, $request->validated());

        if (! $result->success) {
            return $this->error_message($result->message);
        }

        return $this->success_message($result->data, $result->message);

    } catch (Exception $e) {
        return $this->error_message($e->getMessage(), 500);
    }
}

}
