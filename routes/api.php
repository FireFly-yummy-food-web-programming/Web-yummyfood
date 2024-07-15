<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\AuctionsController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('buyer')->group(function () {
    Route::post('register', [BuyerController::class, 'register']);
    Route::put('update-profile', [BuyerController::class, 'updateProfile']);
    Route::delete('delete-profile', [BuyerController::class, 'deleteProfile']);
    Route::put('forgot-password', [BuyerController::class, 'forgotPassword']);
    Route::get('auctions', [AuctionsController::class, 'getAuctions']);
    Route::get('auction-history', [AuctionsController::class, 'getAuctionHistory']);
    Route::post('place-deposit', [DepositController::class, 'placeDeposit']);
    Route::post('make-payment', [PaymentController::class, 'makePayment']);
});
