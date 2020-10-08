<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Admin;
use JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name'      => 'required|min:3|max:200|',
            'email'     => 'required|min:10|max:200|email|unique:users',
            'password'  => 'required|min:8|max:200|'
        ]);

        if($validator->fails()){
            return response()->json([
                'status'    => 'error',
                'error'     => $validator->errors()
            ], 422);
        }

        $newUser = new User();
        $newUser->name      = $request->name;
        $newUser->email     = $request->email;
        $newUser->password  = Hash::make($request->password);
        $newUser->address   = $request->address;
        $newUser->phone     = $request->phone;
        $newUser->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User Has Been Created Successfully.',
        ]);
    }

    public function login() {
        // get email and password from request
        $credentials = request(['email', 'password']);

        // try to auth and get the token using api authentication
        if (!$token = auth('api')->attempt($credentials)) {
            // if the credentials are wrong we send an unauthorized error in json format
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(compact('token'))->header('Authorization', $token);

    }

    public function me(){
        $currentUser = JWTAuth::parseToken()->authenticate();

        return response()->json([
           'id'         => $currentUser->id,
           'name'       => $currentUser->name,
           'email'      => $currentUser->email,
           'picture'    => $currentUser->picture,
           'phone'      => $currentUser->phone,
           'address'    => $currentUser->address,
        ]);
    }

    public function logout(){
        auth('api')->logout();
    }
}
