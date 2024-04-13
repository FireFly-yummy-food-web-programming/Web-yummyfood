<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Clients\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Clients\ContactsController;
use App\Http\Controllers\Clients\FavoriteController;
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

// Route::get('/', function () {
//     return view('clients.home');
// })->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('users')->name('users.')->group(function () {
    // Route::get('/about', function () {
    //     return view('About us page');
    // })->name('about');
    Route::get('/register', [RegisterController::class, 'getRegister']);
    Route::post('/register', [RegisterController::class, 'postRegister'])->name('register');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/login', [LoginController::class, 'post'])->name('login.post');
    Route::get('/dish/{id}', [DishController::class, 'getDetail'])->name('dish');
    Route::get('/contact', [ContactsController::class, 'showContactPage'])->name('contact');
    Route::post('/contact', [ContactsController::class, 'submitContact'])->name('contact.submit');
    Route::get('/favorites/add/{id}', [FavoriteController::class, 'addToFavorite'])->name('favorites.add'); 
    Route::get('/listFavorites', [FavoriteController::class, 'getAllFavoriteOfUser'])->name('list-favorites');   

});

Route::prefix('admin')->group(function () {
    //Contacts
    Route::post('/contacts/update-status', [AdminController::class, 'updateStatus'])->name('contacts.updateStatus');
    Route::get('/', [AdminController::class, 'getContacts'])->name('manage-contact');
    Route::get('/manage-categoties', [CategoriesController::class, 'getAllCategories'])->name('manage-categories');
    Route::get('/add-category', [CategoriesController::class, 'getFormAddCategory'])->name('add-category');
    Route::post('/add-category', [CategoriesController::class, 'postAddCategory'])->name('post-add-category');
    Route::post('/delete-category/{id}', [CategoriesController::class, 'deleteCategory'])->name('delete-category');
    Route::post('/restore-category/{id}', [CategoriesController::class, 'RestoreCategory'])->name('restore-category');
    Route::get('/edit-category/{id}', [CategoriesController::class, 'getFormEditCategory'])->name('edit-category');
    Route::post('/edit-category/{id}', [CategoriesController::class, 'postEditCategory'])->name('post-edit-category');
    Route::get('/manage-oders', [OrdersController::class, 'getAllOrders'])->name('manage-orders');
    Route::post('/order/update-status', [OrdersController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('/manage-dish', [DishController::class, 'getDish'])->name('manage-dish');
    Route::get('/add-dish', [DishController::class, 'getFormAdddish'])->name('add-dish');
    Route::post('/add-dish', [DishController::class, 'postAdddish'])->name('post-add-dish');
    Route::post('/delete-dish/{id}', [DishController::class, 'deleteDish'])->name('delete-dish');
    Route::post('/restore-dish/{id}', [DishController::class, 'RestoreDish'])->name('restore-dish');
    Route::get('/edit-dish/{id}', [DishController::class, 'getFormEditdish'])->name('edit-dish');
    Route::post('/edit-dish/{id}', [DishController::class, 'postEditdish'])->name('post-edit-category');
    Route::get('/manage-banners', [BannersController::class, 'index'])->name('manage-banners');
    Route::get('/add-banner', [BannersController::class, 'create'])->name('add-banner');
    Route::post('/add-banner', [BannersController::class, 'store'])->name('add-banner');
    Route::get('/edit-banner/{id}', [BannersController::class, 'edit'])->name('edit-banner');
    Route::post('/edit-banner/{id}', [BannersController::class, 'update'])->name('update-banner');
    // Route::post('/delete-banner/{id}', [BannersController::class, 'destroy'])->name('delete-banner');
    Route::post('/soft-delete-banner/{id}', [BannersController::class, 'softDelete'])->name('soft-delete-banner');
    Route::get('/soft-delete-banner/{id}', [BannersController::class, 'softDelete'])->name('soft-delete-banner');
    Route::post('/restore-banner/{id}', [BannersController::class, 'restore'])->name('restore-banner');
    Route::post('/permanent-delete-banner/{id}', [BannersController::class, 'permanentDelete'])->name('permanent-delete-banner');
     Route::get('/manage-users', [UsersController::class,'getUsers'])->name('manage-users');
     Route::get('/add-users', [UsersController::class, 'getFormAddUsers'])->name('add-users');
     Route::post('/add-users', [UsersController::class, 'postAddUsers'])->name('post-add-users');
     Route::post('/delete-users/{id}', [UsersController::class, 'deleteUsers'])->name('delete-users');
     Route::post('/restore-users/{id}', [UsersController::class, 'restoreUsers'])->name('restore-users');
     Route::get('/edit-users/{id}', [UsersController::class, 'getFormEditUsers'])->name('edit-users');
     Route::post('/edit-users/{id}', [UsersController::class, 'postEditUsers'])->name('post-edit-users');
    // Route::get('/manage-banner', [BannerController::class,'getContacts'])->name('manage-banner');
});