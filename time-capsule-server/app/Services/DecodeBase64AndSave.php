<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DecodeBase64AndSave
{
   public static function decodeBase64AndSave($base64String)
    {
        if (strpos($base64String, ';base64,') !== false) {
            [$typeInfo, $base64Data] = explode(';base64,', $base64String);
            if (!preg_match('/^data:image\/(\w+)/', $typeInfo, $matches)) {
                return null;
            }
            $extension = $matches[1];
        } else {
            $base64Data = $base64String;
            $extension = 'jpg';
        }

        $fileName = Str::uuid() . '.' . $extension;
        //dd($fileName);
        $filePath = 'CapsuleImages/' . $fileName;
        //dd($filePath);

        Storage::disk('local')->put($filePath, base64_decode($base64Data));
        return $fileName;
    }
}
