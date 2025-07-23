<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Capsule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\DecodeBase64AndSave;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;
use App\Mail\CapsuleRevealedMail;

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
        self::updateRevealedCapsules();
        $user = User::find($id);
        return $user->capsules()->with('tags')->get();
    }

    static function getPublicWallCapsules($request)
    {
        self::updateRevealedCapsules();

        $capsules = Capsule::with('user')->with('tags')->where('status', 'public')->where('revealed', true);

        if ($request->selected_country) {
            $capsules->where('country', $request->selected_country);
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
        return response($fileContent, 200);
    }

    static function addOrUpdate($request, $capsule)
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
            $capsule->image_path = DecodeBase64AndSave::decodeBase64AndSave($request->input('image_base64'));
        }

        $attributes = [
            'user_id',
            'title',
            'description',
            'status',
            'message',
            'surprise_mode',
            'reveal_date',
            'color',
            'revealed',
            'audio_path',
        ];

        foreach ($attributes as $attr) {
            if ($request->has($attr)) {
                $capsule->$attr = $request->input($attr);
            }
        }
        if ($request->input('status') === 'unlisted') {
            $capsule->identifier = Str::uuid();
        }
        $capsule->save();

        if ($request->has('selected_tags')) {
            $capsule->tags()->sync($request->input('selected_tags'));
        }
        return $capsule;
    }

    static function updateRevealedCapsules()
    {
        $capsules = Capsule::where('revealed', false)
            ->where('reveal_date', '<=', Carbon::now())
            ->with('user')
            ->get();
        foreach ($capsules as $capsule) {
            $capsule->revealed = true;
            $capsule->save();
            Mail::to($capsule->user->email)->send(new CapsuleRevealedMail($capsule));
        }
    }
}
