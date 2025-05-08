<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeStatutController;

$endpoints = ['store', 'update', 'destroy'];

Route::post("auth/login",[AuthController::class,"login"]);

Route::get("auth/user",[AuthController::class,"user"]);

Route::post('query',[QueryController::class,'index']);

Route::resource('type-statuts', TypeStatutController::class)->only($endpoints);

