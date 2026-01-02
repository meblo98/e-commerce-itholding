<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ProduitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('api')->group(function () {
    // Here you can define your API routes
});
//categories
Route::post("/categories", [CategorieController::class, "store"]);
Route::put("/categories/{id}", [CategorieController::class, "update"]);
Route::delete("/categories/{id}", [CategorieController::class, "destroy"]);

//marques
Route::post("/marques", [MarqueController::class, "store"]);
Route::put("/marques/{id}", [MarqueController::class, "update"]);
Route::delete("/marques/{id}", [MarqueController::class, "destroy"]);

//produits
Route::post("/produits", [ProduitController::class, "store"]);
Route::put("/produits/{id}", [ProduitController::class, "update"]);
Route::delete("/produits/{id}", [ProduitController::class, "destroy"]);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', fn () => view('admin.view.index'));
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn () => view('admin.view.index'));
});
