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

            Ingredients::where('recipe_id', '=', $recipe->id)
                ->where('id', '=', $id)
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

    public function update(IngredientsRequest $request, $recipe_id)
    {
        try {
            $request->validated();
            $req = json_decode(json_encode($request->input()));

            $user = JWTAuth::parseToken()->authenticate();
            $recipe = Recipe::find($recipe_id)->get()->first();
            if (!$recipe->user_id == $user->id) {
                return response([
                    "error" => [
                        "message" => "The request id and the user did not match."
                    ]
                ], 404);
            }

            foreach ($req as $node) {
                try {
                    Ingredients::find($node->id)
                        ->update([
                            "name" => $node->name,
                            "amount" => $node->amount,
                            "measuring_instrument" => $node->measuring_instrument
                        ]);
                } catch (Throwable $e) {
                    return response([
                        "error" => [
                            "message" => "something went wrong updating the id of {$node->id}, values after the said data are updated successfully."
                        ]
                    ], 500);
                }
            }

            return ["success" => ["message" => "ingredients updated"]];
        } catch (Throwable $e) {
            return response([
                "error" => [
                    "message" => strval($e)
                ]
            ], 500);
        }
    }
}
