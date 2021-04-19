<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response([
                    "errors" =>
                    ["message" => "Invalid Credentials"]
                ], 500);
            }
        } catch (JWTException $e) {
            return response([
                "errors" =>
                ["message" => "Could not create token, please try again."]
            ], 500);
        }

        return (compact('token'));
    }

    public function store(UserRequest $request)
    {
        $request->validated();

        try {
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            $token = JWTAuth::fromUser($user);
            return response(compact('user', 'token'), 201);
        } catch (Throwable $e) {
            return response(["error" => ["message" => $e]], 500);
        }
    }

    public function info()
    {
        return JWTAuth::parseToken()->authenticate();
    }
}
