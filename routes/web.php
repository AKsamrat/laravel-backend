<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PostController::class,'index'])->name('post.index');
Route::get('/posts/{id}',[PostController::class,'show'])->name('posts.show');

Route::get('/register',[AuthController::class,'register'])->name('register.get');
Route::post('/register',[AuthController::class,'registerStore'])->name('register.post');

Route::get('/login',[AuthController::class,'login'])->name('login.get');
Route::get('/login',[AuthController::class,'loginStore'])->name('login.post');

