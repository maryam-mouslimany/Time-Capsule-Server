<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Capsule;
use App\Services\CapsuleService;


class CapsuleController extends Controller
{
    function getCapsules($id = null)
    {
        $capsules = CapsuleService::getCapsule($id);
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
