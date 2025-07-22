<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Capsule;
use Illuminate\Support\Str;
use App\Services\DecodeBase64AndSave;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;


class CapsuleService
{
    static function getCapsule($param)
    {
        if (is_numeric($param)) {
            $capsule = Capsule::with('user')->with('tags')->find($param);
        } else {
            $capsule = Capsule::with('user')->with('tags')->where('identifier', $param)->first();
        }
        return $capsule;
    }

    static function getDashboardCapsules($id)
    {
        $user = User::find($id);
        return $user->capsules()->with('tags')->get();
    }

    static function getPublicWallCapsules($request)
    {
        Capsule::where('status', 'public')
            ->where('revealed', false)
            ->where('reveal_date', '<=', Carbon::now())
            ->update(['revealed' => true]);

        $capsules = Capsule::with('user')->with('tags')->where('status', 'public')->where('revealed', true);

        if ($request->filter_country) {
            $capsules->where('country', $request->country);
        }

        if ($request->start_date) {
            $capsules->whereDate('reveal_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $capsules->whereDate('reveal_date', '<=', $request->end_date);
        }

        if ($request->selected_tag) {
            $capsules->whereHas('tags', function ($query)  use ($request) {
                $query->where('tags.id', $request->selected_tag);
            });
        }

        return $capsules->get();
    }

    static function getImage($filename)
    {
        $path = 'CapsuleImages/' . $filename;
        //dd($path);

        if (!Storage::exists($path)) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        $fileContent = Storage::get($path);
        $mimeType = Storage::mimeType($path);
        return response($fileContent, 200)
            ->header('Content-Type', $mimeType);
    }


    static function addOrUpdate($request, $capsule, $id)
    {

        $ip = request()->ip();
        if ($ip === '127.0.0.1') {
            $ip = '8.8.8.8';
        }
        $position = Location::get($ip);

        if ($position) {
            $capsule->country = $position->countryName;
            $capsule->ip_address = $ip;
        } else {
            $capsule->country = null;
            $capsule->ip_address = null;
        }
        if (!empty($request->input('image_base64'))) {
            //dd($request->input('image_base64'));
            $imagePath = DecodeBase64AndSave::decodeBase64AndSave($request->input('image_base64'));
            //dd($imagePath);
            $capsule->image_path = $imagePath;
        }

        $capsule->user_id = $request->input('user_id');
        $capsule->title = $id && !$request->has('title') ? $capsule->title : $request->input('title');
        $capsule->description = $id && !$request->has('description') ? $capsule->description : $request->input('description');
        $capsule->status = $id && !$request->has('status') ? $capsule->status : $request->input('status');
        $capsule->message = $id && !$request->has('message') ? $capsule->message : $request->input('message');
        $capsule->surprise_mode = $id && !$request->has('surprise_mode') ? $capsule->surprise_mode : $request->input('surprise_mode');
        $capsule->reveal_date = $id && !$request->has('reveal_date') ? $capsule->reveal_date : $request->input('reveal_date');
        $capsule->color = $id && !$request->has('color') ? $capsule->color : $request->input('color');
        $capsule->revealed = $id && !$request->has('revealed') ? $capsule->revealed : $request->input('revealed');
        $capsule->audio_path = $id && !$request->has('audio_path') ? $capsule->audio_path : $request->input('audio_path');
        // If unlisted, generate a slug
        if ($request->input('status') === 'unlisted') {
            $capsule->identifier = Str::uuid(); // or use Str::random(16)
        }
        $capsule->save();

        if ($request->has('selected_tags')) {
            $capsule->tags()->sync($request->input('selected_tags'));
        }
        return $capsule;
    }
}
