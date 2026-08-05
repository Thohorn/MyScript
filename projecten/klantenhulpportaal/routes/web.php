<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');


Route::get('/user/resetpassword/{token}', function (string $token) {

})->name('password.reset');