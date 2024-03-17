<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
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
    return view('welcome');
});
Route::prefix('users')->group(function () {
    Route::get('/home', function () {
        return view('layouts.clients');
    })->name('home');
    Route::get('/contact', function () {
        return view('clients.contact');
    })->name('contact');
    Route::get('/about', function () {
        return view('About us page');
    })->name('about');
});
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
});