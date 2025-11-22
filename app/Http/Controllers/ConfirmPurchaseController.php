<?php

namespace App\Http\Controllers;

use App\CalculatePrice;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payments\PaymentController;
use App\Models\CartItem;
use Illuminate\Http\Request;

class ConfirmPurchaseController extends Controller
{
    public function Checkout(CartItem $cart)
    {
      $total_price=CalculatePrice::calculate($cart->quantity,$cart->product->price);
       $cart->delete();
       return $this->success_message(['total_price'=>$total_price]);
    }
}
