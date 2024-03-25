<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Clients\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\CategoriesController;
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
    // Route::get('/contact', function () {
    //     return view('Contact');
    // })->name('contact');
    // Route::get('/about', function () {
    //     return view('About us page');
    // })->name('about');
    Route::get('/register', [RegisterController::class, 'getRegister']);
    Route::post('/register', [RegisterController::class, 'postRegister'])->name('register');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/login', [LoginController::class, 'post'])->name('login.post');
});

Route::prefix('admin')->group(function () {
    //Contacts
    Route::get('/', [AdminController::class, 'getContacts'])->name('manage-contact');
    Route::get('/manage-categoties', [CategoriesController::class, 'getAllCategories'])->name('manage-categories');
    Route::get('/add-category', [CategoriesController::class, 'getFormAddCategory'])->name('add-category');
    Route::post('/add-category', [CategoriesController::class, 'postAddCategory'])->name('post-add-category');
    Route::post('/delete-category/{id}', [CategoriesController::class, 'deleteCategory'])->name('delete-category');
    Route::post('/restore-category/{id}', [CategoriesController::class, 'RestoreCategory'])->name('restore-category');
    Route::get('/edit-category/{id}', [CategoriesController::class, 'getFormEditCategory'])->name('edit-category');
    Route::post('/edit-category/{id}', [CategoriesController::class, 'postEditCategory'])->name('post-edit-category');
    Route::get('/manage-oders', [OrdersController::class, 'getAllOrders'])->name('manage-orders');
    Route::get('/manage-dish', [DishController::class, 'getDish'])->name('manage-dish');
    Route::get('/add-dish', [DishController::class, 'getFormAdddish'])->name('add-dish');
    Route::post('/add-dish', [DishController::class, 'postAdddish'])->name('post-add-dish');
    // Route::post('/delete-dish/{id}', [DishController::class, 'deletedish'])->name('delete-dish');
    // Route::post('/restore-dish/{id}', [DishController::class, 'Restoredish'])->name('restore-dish');
    // Route::get('/edit-dish/{id}', [DishController::class, 'getFormEditdish'])->name('edit-dish');
    // Route::post('/edit-dish/{id}', [DishController::class, 'postEditdish'])->name('post-edit-category');


    // Route::get('/manage-users', [UsersController::class,'getContacts'])->name('manage-users');
    // Route::get('/manage-banner', [BannerController::class,'getContacts'])->name('manage-banner');
});