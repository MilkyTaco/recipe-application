<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProceduresRequest;
use App\Models\Procedures;
use App\Models\Recipe;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProceduresController extends Controller
{
    public function store(ProceduresRequest $request)
    {
        $request->validated();
        if (empty($request->input()))
            return response([
                "error" => ["message" => "empty request"]
            ], 500);

        try {
            Procedures::insert($request->input());
            return ["success" => ["message" => "procedures added"]];
        } catch (Throwable $e) {
            return response(["error" => ["message" => strval($e)]], 500);
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

            Procedures::find($id)
                ->where('recipe_id', '=', $recipe->id)
                ->delete();

            return ["success" => ["message" => "procedure deleted"]];
        } catch (Throwable $e) {
            return response([
                "error" => [
                    "message" => strval($e)
                ]
            ], 500);
        }
    }

    public function update(ProceduresRequest $request, $recipe_id)
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
                    Procedures::find($node->id)
                        ->update([
                            "description" => $node->description,
                            "duration" => $node->duration,
                            "step_count" => $node->step_count
                        ]);
                } catch (Throwable $e) {
                    return response([
                        "error" => [
                            "message" => strval($e)
                        ]
                    ], 500);
                }
            }

            return ["success" => ["message" => "procedures updated"]];
        } catch (Throwable $e) {
            return response([
                "error" => [
                    "message" => strval($e)
                ]
            ], 500);
        }
    }
}
