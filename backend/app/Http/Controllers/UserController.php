<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
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
        
        $req->password = Hash::make('secret');
        $user->password = $req->password;

        try {
            $user->save();
            return ["success" => ["message" => "user saved successfully!", "data" => $user]];
        } catch (Throwable $e) {
            return response(["errors" => ["message" => "unresolved"]], 500);
        }
    }
}
