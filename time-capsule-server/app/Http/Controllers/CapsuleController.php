<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Capsule;
use App\Traits\ResponseTrait;
use App\Services\CapsuleService;


class CapsuleController extends Controller
{
    function getCapsules($id = null)
    {
        $capsules = CapsuleService::getCapsules($id);
        return ResponseTrait::response($capsules);
    }

    function getPublicWallCapsules(){
        $capsules = CapsuleService::getPublicWallCapsules();
        return ResponseTrait::response($capsules);
    }

    function addOrUpdateCapsule(Request $request, $id = null)
    {
        $capsule = new Capsule;
        if ($id) {
            $capsule = Capsule::find($id);
        }

        CapsuleService::addOrUpdate($request, $capsule, $id);
        return ResponseTrait::response($capsule);
    }
}
