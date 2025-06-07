<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\QueryController;

$endpoints = ['store', 'update', 'destroy'];

Route::post('/auth/login', [AuthController::class, 'login'])->name("login");


Route::middleware('auth:sanctum')->group(function () use ($endpoints) {

    Route::get('/divin', [QueryController::class,'index']);


    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/user', [AuthController::class, 'me']);

    Route::post('query', [QueryController::class,'index']);

    Route::resource('roles', RoleController::class)->only($endpoints);

});
