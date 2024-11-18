<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\estudianteControlador;

//Route::get('/user', function (Request $request) {
    //return $request->user();
//})->middleware('auth:sanctum');

Route::get("/estudiante", [estudianteControlador::class, 'index']);

Route::post("/estudiante", [estudianteControlador::class, 'store']);

Route::get("/estudiante/{id}", [estudianteControlador::class, 'show']);

Route::put("/estudiante/{id}", [estudianteControlador::class, 'update']);

Route::patch("/estudiante/{id}", [estudianteControlador::class, 'updatePartial']);

Route::delete("/estudiante/{id}", [estudianteControlador::class,]);