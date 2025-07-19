<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CapsuleController;
use App\Http\Controllers\AuthController;

Route::get("/capsule/{id?}", [CapsuleController::class, "getCapsule"]);
Route::post("/add_update_capsule/{id?}", [CapsuleController::class, "addOrUpdateCapsule"]);
Route::get("/public_wall_capsules", [CapsuleController::class, "getPublicWallCapsules"]);
Route::post("/login", [AuthController::class, "login"]);