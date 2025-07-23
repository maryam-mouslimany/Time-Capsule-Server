<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DecodeBase64AndSave
{
    public static function saveBase64Media($base64String)
    {
        if (strpos($base64String, ';base64,') !== false) {
            [$typeInfo, $base64Data] = explode(';base64,', $base64String);

            if (!preg_match('/^data:(image|audio)\/(\w+)/', $typeInfo, $matches)) {
                return null;
            }

            $type = $matches[1];
            $extension = $matches[2];
        } else {
            $base64Data = $base64String;

            // Guess by signature
            if (str_starts_with($base64Data, 'SUQz')) {
                $type = 'audio';
                $extension = 'mp3';
            } else {
                $type = 'image';
                $extension = 'jpg';
            }
        }

        $fileName = Str::uuid() . '.' . $extension;

        if ($type === 'image') {
            $folder = 'CapsuleImages';
            $filePath = $folder . '/' . $fileName;

            Storage::disk('local')->put($filePath, base64_decode($base64Data));

            return $fileName;
        }

        if ($type === 'audio') {
            $folder = 'CapsuleAudios';
            $filePath = $folder . '/' . $fileName;

            Storage::disk('local')->put($filePath, base64_decode($base64Data));

            return $fileName;
        }

        return null;
    }
}
