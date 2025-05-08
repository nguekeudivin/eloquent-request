<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeStatutController;

$endpoints = ['store', 'update', 'destroy'];


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/auth/user', [AuthController::class, 'me']);
});

// Route pour le login (NON protégée)
Route::post('/auth/login', [AuthController::class, 'login']);

Route::post('query',[QueryController::class,'index']);

Route::resource('type-statuts', TypeStatutController::class)->only($endpoints);

