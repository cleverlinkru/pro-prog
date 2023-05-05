<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'shop/quick-buy', 'as' => 'shop.quickBuy.'], function () {
    Route::post('confirm', [\App\Http\Controllers\Shop\QuickBuyController::class, 'confirm'])->name('confirm');
});
