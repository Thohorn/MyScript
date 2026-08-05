<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/forgotpassword', [AuthController::class, 'forgotpassword']);
Route::post('/resetpassword', [AuthController::class, 'resetpassword']);

Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
