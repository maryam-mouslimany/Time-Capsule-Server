<?php

namespace App\Traits;

trait ResponseTrait
{
    static function response($payload, $status = true, $status_code = 200)
    {
        return response()->json([
            "status" => $status,
            "payload" => $payload
        ], $status_code);
    }
}
