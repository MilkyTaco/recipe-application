<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientsRequest;
use App\Models\Ingredients;
use App\Models\Recipe;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;

class IngredientsController extends Controller
{
    public function store(IngredientsRequest $request)
    {
        $request->validated();
        if (empty($request->input()))
        return response([
            "error" => ["message" => "empty request"]
        ], 500);

        try {
            Ingredients::insert($request->input());
            return ["success" => ["message" => "ingredients added"]];
        } catch (Throwable $e) {
            return response(["error" => ["message" => $e]], 500);
        }
    }

    public function destroy($id, $recipe_id)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $recipe = Recipe::where('user_id', '=', $user->id)
                ->where('id', '=', $recipe_id)
                ->get()
                ->first();

            Ingredients::find($id)
                ->where('recipe_id', '=', $recipe->id)
                ->delete();

            return ["success" => ["message" => "ingredient deleted"]];
        } catch (Throwable $e) {
            return response([
                "error" => [
                    "message" => "Uncaught Error: Something went wrong or the record was not found"
                ]
            ], 500);
        }
    }
}
