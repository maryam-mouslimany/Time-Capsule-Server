<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use Illuminate\Http\Request;
use App\Services\CapsuleService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestEmail;


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

    function addOrUpdateCapsule(Request $request, $id = null)
    {
        $capsule = new Capsule;
        if ($id) {
            $capsule = Capsule::find($id);
        }

        CapsuleService::addOrUpdate($request, $capsule, $id);
        return $this->response($capsule);
    }

    function getImage($filename)
    {
        return CapsuleService::getImage($filename);
    }

    public function sendEmail()
    {
        Mail::to('mouslimanymaryam@gmail.com')->send(new MyTestEmail());

        return response()->json(['message' => 'Email sent successfully']);
    }
}
