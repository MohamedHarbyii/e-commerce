<?php

namespace App;

trait Messages
{
 public  function success_message($data,$message,$status)
 {
     return response()->json(['data'=>$data,'message'=>$message],$status);
 }
    public static function error_message($data,$message,$status)
    {
        return response()->json(['data'=>$data,'message'=>$message],$status);
    }
}
