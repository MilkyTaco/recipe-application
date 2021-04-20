<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;

class RecipeController extends Controller
{
    public function store(RecipeRequest $request)
    {
        $request->validated();
        $req = json_decode(json_encode($request->input()));
        $user = JWTAuth::parseToken()->authenticate();
        $recipe = new Recipe();

        $recipe->user_id = $user->id;
        $recipe->title = $req->title;
        $recipe->description = $req->description;

        try {
            $recipe->save();
            return $recipe;
        } catch (Throwable $e) {
            return response(["error" => ["message" => $e]], 500);
        }
    }

    public function show()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return Recipe::find($user->id, 'user_id')
                ->with('procedures', 'ingredients')
                ->get()
                ->makeHidden(['user_id', 'updated_at']);

        } catch (Throwable $e) {
            return [];
        }
    }
}
