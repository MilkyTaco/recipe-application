<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $request->validated();
        $req = json_decode(json_encode($request->input()));

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);

        try {
            $user->save();
            return [
                "success" => [
                    "message" => "user saved successfully!",
                    "data" => [
                        "name" => $user->name,
                        "email" => $user->email,
                        "id" => HASH::make($user->id)
                    ]
                ]
            ];
        } catch (Throwable $e) {
            return response(["errors" => ["message" => "unresolved"]], 500);
        }
    }

    public function login(Request $request)
    {
        $req = json_decode(json_encode($request->input()));

        $user = User::where('email', $req->email)
            ->get()->first();

        try {
            if (Hash::check($request->password, $user->password)) {
                return ["success" => [
                    "message" => "user saved successfully!",
                    "data" => [
                        "name" => $user->name,
                        "email" => $user->email,
                        "id" => HASH::make($user->id)
                    ]
                ]];
            }
            return response(["errors" => ["message" => "invalid password"]], 500);
        } catch (Throwable $e) {
            return response(["errors" => ["message" => "uncaught error"]], 500);
        }
    }
}
