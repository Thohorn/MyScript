<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/welcome', 'welcome');

Route::get('/hello', function () {
    return 'Hello, World!';
});

Route::resource('items', ItemController::class);

// We voegen ook een redirect toe aan de routes die de hoofdpagina doorverwijst naar de '/items' route
Route::redirect('/', '/items');
