<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientsRequest;
use App\Models\Ingredients;
use Throwable;

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
}
