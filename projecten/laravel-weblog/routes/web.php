<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index')->name('posts.index');

    Route::get('/posts/create', 'create')
        ->middleware('auth')
        ->name('posts.create');

    Route::post('/posts', 'store')->name('posts.store');
    Route::get('/posts/{post}', 'show')->name('posts.show');

    Route::get('/posts/{post}/edit', "edit")
        ->middleware('auth')
        ->can('update', 'post')
        ->name('posts.edit');

    Route::patch('/posts/{post}', "update")
        ->middleware('auth')
        ->can('update', 'post')
        ->name('posts.update');

    Route::delete('/posts/{post}', "destroy")
        ->middleware('auth')
        ->can('delete', 'post')
        ->name('posts.destroy');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')
        ->middleware('auth')
        ->name('users.index');

    Route::post('/users/login', 'authenticate')
        ->middleware('throttle:5,1')
        ->name('users.login.authenticate');

    Route::get('/users/login', 'login')->name('login');
    Route::post('logout', 'logout')->name('users.logout');

    Route::get('/users/register', 'create')->name('users.create');
    Route::post('/users/register', 'store')->name('users.store');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index');

    Route::get('/categories/create', 'create')
        ->middleware('auth')
        ->name('categories.create');

    Route::post('/categories', 'store')->name('categories.store');
});

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::redirect('/', '/posts');
