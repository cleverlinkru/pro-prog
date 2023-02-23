<?php

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

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
], function () {
    Route::get('', [\App\Http\Controllers\AuthController::class, 'main'])->name('main');
    Route::group(['middleware' => 'throttle:5,1'], function () {
        Route::post('sign-in-send-code', [\App\Http\Controllers\AuthController::class, 'signInSendCode'])->name('signInSendCode');
        Route::post('sign-up-send-code', [\App\Http\Controllers\AuthController::class, 'signUpSendCode'])->name('signUpSendCode');
        Route::post('sign-in', [\App\Http\Controllers\AuthController::class, 'signIn'])->name('signIn');
        Route::post('sign-up', [\App\Http\Controllers\AuthController::class, 'signUp'])->name('signUp');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('', function () {
        return redirect()->route('auth.main');
    })->name('home');
});
