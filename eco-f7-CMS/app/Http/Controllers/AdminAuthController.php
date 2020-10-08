<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use JWTAuth;

class AdminAuthController extends Controller
{
    function __construct()
    {
        Config::set('jwt.user', Admin::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => Admin::class,
        ]]);
    }

    public function login(Request $request){
        // get email and password from request
        $credentials = $request->only('email', 'password');

        // try to auth and get the token using api authentication
        if (!$token = JWTAuth::attempt($credentials)) {
            // if the credentials are wrong we send an unauthorized error in json format
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(compact('token'))->header('Authorization', $token);
    }
}
