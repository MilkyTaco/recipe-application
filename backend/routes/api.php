<?php

use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\NewRecipeController;
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
    Route::get('show/all', [RecipeController::class, "showAll"]);
});

Route::middleware("jwt.verify")->prefix('procedures')->group(function () {
    Route::post('create/recipe_id={recipe_id}', [ProceduresController::class, "store"]);
    Route::delete('delete/id={id}&recipe_id={recipe_id}', [ProceduresController::class, "destroy"]);
    Route::put('update/recipe_id={recipe_id}', [ProceduresController::class, "update"]);
});

Route::middleware("jwt.verify")->prefix('ingredients')->group(function () {
    Route::post('create/recipe_id={recipe_id}', [IngredientsController::class, "store"]);
    Route::delete('delete/id={id}&recipe_id={recipe_id}', [IngredientsController::class, "destroy"]);
    Route::put('update/recipe_id={recipe_id}', [IngredientsController::class, "update"]);
});

Route::middleware("jwt.verify")->group(function () {
    Route::apiResource('recipe', NewRecipeController::class);
    Route::post('uploadFeaturedImage', [NewRecipeController::class, 'uploadFeaturedImage']);
});

Route::get('categories', [RecipeController::class, 'category']);
