<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('post.show');

Route::get('/register', [AuthController::class, 'register'])->name('register.get');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.post');

Route::get('/login', [AuthController::class, 'login'])->name('login.get');
Route::post('/login', [AuthController::class, 'loginStore'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name(name: 'logout');
Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/post', [DashboardController::class, 'ownPosts'])->name('dashboard.posts');

    Route::get('/dashboard/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/dashboard/posts', [PostController::class, 'store'])->name('post.store');

    Route::get('/dashboard/posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/dashboard/posts/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/dashboard/posts/{id}', [PostController::class, 'destroy'])->name('post.destroy');
});
