<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], static function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthManager::class, 'login']);
        Route::post('/register', [AuthManager::class, 'register']);
        Route::post('/reset-password', [AuthManager::class, 'resetPassword']);
        Route::post('/regenerate-verification-token', [AuthManager::class, 'regenerateToken']);
        Route::post('/verify-account', [AuthManager::class, 'verifyAccount']);
        Route::post('/forgot-password', [AuthManager::class, 'forgotPassword']);
    });
});
