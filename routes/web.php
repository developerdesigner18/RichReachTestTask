<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[PostController::class,'home'])->name('home');

Route::group(['middleware' => 'guest:web'], function () {
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login-check',[LoginController::class,'loginCheck'])->name('login-check');

    Route::get('/register',[LoginController::class,'registerView'])->name('register');
    Route::post('/register',[LoginController::class,'register'])->name('register.create');

});

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/dashboard',[PostController::class,'index'])->name('dashboard');
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');

    Route::post('add-post',[PostController::class,'addPost'])->name('add-post');
    Route::post('delete-post',[PostController::class,'deletePost'])->name('delete-post');
    Route::get('edit-post',[PostController::class,'editPost'])->name('edit-post');
    Route::post('update-post',[PostController::class,'updatePost'])->name('update-post');
});
