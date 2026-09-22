<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
    Route::post('/forgotpassword', 'forgotpassword');
    Route::post('/resetpassword', 'resetpassword');

    Route::get('/me', 'me')->middleware('auth:sanctum');
});

Route::controller(TicketController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/tickets', 'index');
    Route::post('/tickets', 'store');
    Route::put('/tickets/{ticket}', 'update');
});

Route::controller(UserController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/user', 'index');
});

Route::controller(CategoryController::class)->middleware(['auth:sanctum', EnsureIsAdmin::class ])->group(function () {
    Route::get('/categories', 'index')->withoutMiddleware(EnsureIsAdmin::class);
    Route::post('/categories', 'store');
    Route::put('/categories/{category}', 'update');
    Route::delete('/categories/{category}', 'destroy');
});

Route::controller(ResponseController::class)->middleware('auth:sanctum')->group(function (){
    Route::get('/responses/{ticket}', 'index');
});
