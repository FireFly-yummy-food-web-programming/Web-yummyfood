<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DishController;
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
        return view('Contact');
    })->name('contact');
    Route::get('/about', function () {
        return view('About us page');
    })->name('about');
});
Route::prefix('admin')->group(function () {
    //Contacts
    Route::get('/', [AdminController::class, 'getContacts'])->name('contact');
    // Route::get('/manage-oders', [OrdersController::class,'get'])->name('manage-oders');
    Route::get('/manage-dish', [DishController::class,'getDish'])->name('manage-dish');
    // Route::get('/manage-users', [UsersController::class,'getContacts'])->name('manage-users');
    // Route::get('/manage-banner', [BannerController::class,'getContacts'])->name('manage-banner');
});