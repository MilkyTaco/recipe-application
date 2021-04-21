<?php

use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\ProceduresController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('user')->group(function () {
    Route::post('login', [UserController::class, "login"]);
    Route::post('signup', [UserController::class, "store"]);
    Route::get('profile', [UserController::class, "info"])->middleware("jwt.verify");
});

Route::middleware("jwt.verify")->prefix('recipe')->group(function () {
    Route::post('create', [RecipeController::class, "store"]);
    Route::delete('delete/id={id}', [RecipeController::class, "destroy"]);
    Route::put('update', [RecipeController::class, "update"]);
    Route::get('show', [RecipeController::class, "show"]);
});

Route::middleware("jwt.verify")->prefix('procedures')->group(function () {
    Route::post('create', [ProceduresController::class, "store"]);
    Route::delete('delete/id={id}&recipe_id={recipe_id}', [ProceduresController::class, "destroy"]);
});

Route::middleware("jwt.verify")->prefix('ingredients')->group(function () {
    Route::post('create', [IngredientsController::class, "store"]);
    Route::delete('delete/id={id}&recipe_id={recipe_id}', [IngredientsController::class, "destroy"]);
});
