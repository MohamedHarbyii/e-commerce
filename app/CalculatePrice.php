<?php

namespace App;

abstract class CalculatePrice
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function calculate($amount,$price)
    {
        return $amount*$price;
    }
}
