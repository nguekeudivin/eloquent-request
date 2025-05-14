<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeStatutController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MutualisteController;

$endpoints = ['store', 'update', 'destroy'];

// Route pour le login (NON protégée)
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () use($endpoints){
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/auth/user', [AuthController::class, 'me']);


    Route::post('query',[QueryController::class,'index']);

    Route::resource('type-statuts', TypeStatutController::class)->only($endpoints);

    Route::resource('roles', RoleController::class)->only($endpoints);

    Route::resource('notifications', NotificationController::class)->only($endpoints);
    Route::patch('/notifications/{userId}/read-all', [NotificationController::class,'readAll']);

    Route::resource('admins', AdminController::class)->only($endpoints);

    Route::resource('mutualistes', MutualisteController::class)->only($endpoints);

    Route::resource('ayant-droits', AyantDroitController::class)->only($endpoints);

});



