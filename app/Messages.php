<?php

namespace App;

trait Messages
{
    public function success_message($data = [], $message = 'Operation Successful', $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * رد الخطأ الموحد
     */
    public function error_message($message = 'Something went wrong', $code = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $code);
    }
}
