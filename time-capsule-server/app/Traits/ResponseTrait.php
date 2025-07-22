<?php

namespace App\Traits;

trait ResponseTrait
{
    static function response($payload, $status = true, $status_code = 200, $message = '')
    {
        return response()->json([
            "status" => $status,
            "payload" => $payload,
            "message" => $message
        ], $status_code);
    }
}
