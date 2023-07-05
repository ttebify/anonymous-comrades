<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\PasswordController;
use App\Http\Controllers\Api\Auth\RegistrationController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1'], static function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', [RegistrationController::class, 'register'])->name('register');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('forgot-password');
        Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('reset-password');
    });

    Route::group(['prefix' => 'users', 'middleware' => ['auth:sanctum']], function () {
        Route::get('/me', [UserController::class, 'getCurrentUser'])->name('user.profile');
        Route::post('/me', [UserController::class, 'updateProfile'])->name('user.update-profile');
        Route::get('/{uuid}', [UserController::class, 'getUserProfile'])->name('user.get-profile');
    });
});
