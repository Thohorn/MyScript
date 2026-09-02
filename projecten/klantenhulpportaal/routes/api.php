<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

Route::controller(TicketController::class)->group(function () {
    Route::get('/tickets', 'index');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index');
});
