<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CapsuleController;
use App\Http\Controllers\TagController;

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);
Route::get('/capsule_image/{filename}', [CapsuleController::class, 'getImage']);
Route::get('/capsule_audio/{filename}', [CapsuleController::class, 'getAudio']);
Route::get('/capsule_unlisted/{identifier}', [CapsuleController::class, 'showUnlisted']);
Route::get('/send_email', [CapsuleController::class, 'sendEmail']);

Route::group(["middleware" => "auth:api"], function () {

    Route::get("/capsule/{id}", [CapsuleController::class, "getCapsule"]);
    Route::get("/public_wall_capsules", [CapsuleController::class, "getPublicWallCapsules"]);
    Route::get("/dashboard_capsules/{id}", [CapsuleController::class, "getDashboardCapsules"]);
    Route::post("/add_update_capsule/{id}", [CapsuleController::class, "addOrUpdateCapsule"]);
    Route::post("/add_update_capsule/add", [CapsuleController::class, "addOrUpdateCapsule"]);
    Route::get("/get_tags", [TagController::class, "getTags"]);
    Route::get("/get_countries", [CapsuleController::class, "getCountries"]);
});
