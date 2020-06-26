<?php

namespace App\Response;

class Success
{
    public static function generic($message, $data, $code)
    {
        return response()->json([
            'status'     => "success",
            'message'    => $message,
            'data'       => $data,
        ], $code);
    }
}
