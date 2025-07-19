<?php

namespace App\Services;

use App\Models\Capsule;
use Carbon\Carbon;

class CapsuleService
{
    static function getCapsule($id)
    {
        if (!$id) {
            return null;
        }
        return Capsule::find($id);
    }

    static function getPublicWallCapsules()
    {
        Capsule::where('status', 'public')
            ->where('revealed', false)
            ->where('reveal_date', '<=', Carbon::now())
            ->update(['revealed' => true]);

        return Capsule::where('status', 'public')
            ->where('revealed', true)
            ->with('tags') 
            ->with('user')
            ->get();
    }

    static function addOrUpdate($request, $capsule, $id)
    {
        $capsule->user_id = 0;
        $capsule->title = $id && !isset($request["title"]) ?  $capsule->title : $request["title"];
        $capsule->description =  $id && !isset($request["description"]) ?  $capsule->description : $request["description"];
        $capsule->status = $id && !isset($request["status"]) ?  $capsule->status : $request["status"];;
        $capsule->message =  $id && !isset($request["message"]) ? $capsule->message : $request["message"];
        $capsule->surprise_mode =  $id && !isset($request["surprise_mode"]) ? $capsule->surprise_mode : $request["surprise_mode"];
        $capsule->reveal_date =  $id && !isset($request["reveal_date"]) ? $capsule->reveal_date : $request["reveal_date"];
        $capsule->ip_address =  $id && !isset($request["ip_address"]) ? $capsule->ip_address : $request["ip_address"];
        $capsule->country =  $id && !isset($request["country"]) ? $capsule->country : $request["country"];
        $capsule->revealed =  $id && !isset($request["revealed"]) ? $capsule->revealed : $request["revealed"];
        $capsule->image_path =  $id && !isset($request["image_path"]) ? $capsule->image_path : $request["image_path"];
        $capsule->audio_path =  $id && !isset($request["audio_path"]) ? $capsule->audio_path : $request["audio_path"];
        $capsule->save();

        return $capsule;
    }
}
