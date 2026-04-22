<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(BookController::class)->group(function() {
    Route::get('/books', 'index');
    Route::post('/books', 'store');
    Route::put('/books/{book}', 'update');
    Route::delete('/books/{book}', 'destroy');
});

Route::get('/authors', [AuthorController::class, 'index']);