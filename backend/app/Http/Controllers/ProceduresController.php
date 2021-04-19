<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProceduresRequest;
use App\Models\Procedures;
use Throwable;

class ProceduresController extends Controller
{
    public function store(ProceduresRequest $request)
    {
        $request->validated();

        try {
            Procedures::insert($request->input());
            return ["success" => ["message" => "procedures added"]];
        } catch (Throwable $e) {
            return response(["error" => ["message" => $e]], 500);
        }
    }
}
