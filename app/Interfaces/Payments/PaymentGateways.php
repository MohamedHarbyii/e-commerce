<?php

namespace App\Interfaces\Payments;


interface PaymentGateways
{
   public function pay(float $amount,array $data);
}
