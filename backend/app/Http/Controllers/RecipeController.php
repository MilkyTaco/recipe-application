<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Ingredients;
use App\Models\Procedures;
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
            return Recipe::where('user_id', '=', $user->id)
                ->with('procedures', 'ingredients')
                ->get()
                ->makeHidden(['user_id', 'updated_at']);
        } catch (Throwable $e) {
            return response(["error" => ["message" => $e]], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $recipe = Recipe::where('user_id', '=', $user->id)
                ->where('id', '=', $id)
                ->get()
                ->first();

            Ingredients::where('recipe_id', '=', $recipe->id)
                ->delete();

            Procedures::where('recipe_id', '=', $recipe->id)
                ->delete();

            Recipe::where('user_id', '=', $user->id)
                ->where('id', '=', $id)
                ->delete();

            return ["success" => ["message" => "recipe deleted"]];
        } catch (Throwable $e) {
            return response(["error" => ["message" => $e]], 500);
        }
    }

    public function update(RecipeRequest $request)
    {
        $request->validated();
        $req = json_decode(json_encode($request->input()));
        $user = JWTAuth::parseToken()->authenticate();

        $recipe = Recipe::where('user_id', '=', $user->id)
            ->where('id', '=', $req->id)
            ->get()
            ->first();

        $recipe->title = $req->title;
        $recipe->description = $req->description;

        try {
            $recipe->save();
            return $recipe;
        } catch (Throwable $e) {
            return response(["error" => ["message" => $e]], 500);
        }
    }
}
