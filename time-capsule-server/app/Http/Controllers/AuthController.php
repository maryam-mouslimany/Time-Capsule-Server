<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Services\AuthService;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $user = AuthService::login($request);
        if ($user) {
            return $this->response($user);
        }
        return $this->response(null, false, 401, "Invalid credentials.");
    }

    function register(Request $request)
    {
        $user = AuthService::register($request);
        return $this->response($user);
    }
}
