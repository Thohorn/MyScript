<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index')->name('posts.index');
    Route::get('/posts/create', 'create')->name('posts.create');
    Route::post('/posts', 'store')->name('posts.store');
    Route::get('/posts/{post}', 'show')->name('posts.show');
});

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::view('/users/dashboard', 'users.dashboard')->name('users.dashboard');

Route::view('/users/login', 'users.login')->name('users.login');
Route::post('/users/login', [LoginController::class, 'authenticate'])->name('users.login.authenticate');

Route::post('logout', function () {
    Auth::guard('web')->logout();

    Session::invalidate();
    Session::regenerateToken();

    return redirect('/');
})->name('users.logout');

Route::view('/users/register', 'users.register')->name('users.register.show');
Route::post('/users/register', [RegisterController::class, 'store'])->name('users.register.store');

Route::redirect('/', '/posts');
