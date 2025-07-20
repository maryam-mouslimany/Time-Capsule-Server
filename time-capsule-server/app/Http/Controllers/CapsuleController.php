<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use Illuminate\Http\Request;
use App\Services\CapsuleService;
use App\Http\Controllers\Controller;

class CapsuleController extends Controller
{
    function getPublicWallCapsules(Request $request)
    {
        $capsules = CapsuleService::getPublicWallCapsules($request);
        return $this->response($capsules);
    }

    function getDashboardCapsules($id){
        $capsules = CapsuleService::getDashboardCapsules($id);
        return $this->response($capsules);
    }

    function getCapsule($id){
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
        return$this->response($capsule);
    }

}
