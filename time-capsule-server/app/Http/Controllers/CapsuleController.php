<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use App\Mail\MyTestEmail;
use Illuminate\Http\Request;
use App\Services\CapsuleService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class CapsuleController extends Controller
{
    function getPublicWallCapsules(Request $request)
    {
        $capsules = CapsuleService::getPublicWallCapsules($request);
        return $this->response($capsules);
    }

    function getDashboardCapsules($id)
    {
        $capsules = CapsuleService::getDashboardCapsules($id);
        return $this->response($capsules);
    }

    function getCapsule($id)
    {
        $capsule = CapsuleService::getCapsule($id);
        return $this->response($capsule);
    }

    function addOrUpdateCapsule(Request $request, $param)
    {
        if ($param === 'add') {
            $capsule = new Capsule();
        } else {
            $capsule = Capsule::find($param);

            if (!$capsule) {
                return response()->json([null, false, 404]);
            }
        }
        CapsuleService::addOrUpdate($request, $capsule);
        return $this->response($capsule);
    }

    function getImage($filename)
    {
        return CapsuleService::getImage($filename);
    }

    function sendEmail()
    {
        Mail::to('mouslimanymaryam@gmail.com')->send(new MyTestEmail());

        return response()->json(['message' => 'Email sent successfully']);
    }

    function getCountries()
    {
        return $this->response(DB::table('capsules')->distinct()->pluck('country'));
    }
}
