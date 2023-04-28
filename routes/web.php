<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
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

Route::get('/',[ChatController::class,'index'])->name('home');


Route::group(['middleware'=>'guest'], function(){
    Route::get('/register',[AuthController::class,'registerForm'])->name('register.create');
    Route::post('/register',[AuthController::class,'register'])->name('register.store');
    Route::get('/login',[AuthController::class,'loginForm'])->name('login.create');
    Route::post('/login',[AuthController::class,'login'])->name('login.store');
});
Route::group(['middleware'=>'auth'], function(){
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
});

