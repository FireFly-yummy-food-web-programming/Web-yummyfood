<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Clients\UserController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('layouts.clients');
})->name('home');
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/contact', function () {
        return view('Contact');
    })->name('contact');
    Route::get('/about', function () {
        return view('About us page');
    })->name('about');
    Route::get('/register', [RegisterController::class, 'getRegister']);
    Route::post('/register', [RegisterController::class, 'postRegister'])->name('register');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/login', [LoginController::class, 'post'])->name('login.post');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
});