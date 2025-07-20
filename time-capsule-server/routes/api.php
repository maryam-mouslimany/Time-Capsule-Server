<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CapsuleController;
use App\Http\Controllers\TagController;

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);

Route::group(["middleware" => "auth:api"], function () {

    Route::get("/capsule/{id?}", [CapsuleController::class, "getCapsule"]);
    Route::get("/public_wall_capsules", [CapsuleController::class, "getPublicWallCapsules"]);
    Route::get("/dashboard_capsules/{id}", [CapsuleController::class, "getDashboardCapsules"]);
    Route::post("/add_update_capsule/{id?}", [CapsuleController::class, "addOrUpdateCapsule"]);
    Route::get("/get_tags", [TagController::class, "getTags"]);

});
