<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->middleware('auth')->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/register',[RegisterController::class, 'store'])->name('register.store');
Route::post('/login',[LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LogoutController::class, 'store'])->name('logout');


Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagen.store');

//Like para los post
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like.store');
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.like.destroy');

Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/{user:username}/posts/{post}', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

//Editar Perfil
Route::get('/{user:username}', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/{user:username}/{id}/editar', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/{user:username}/{id}',[ProfileController::class, 'update'] )->name('profile.update');

//Siguiendo a usuarios
Route::post('/{user:username}/follower', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollower', [FollowerController::class, 'destroy'])->name('users.unfollow');
