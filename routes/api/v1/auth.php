<?php

use Illuminate\Support\Facades\Route;
use Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth\LoginController;
use Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth\RegisterController;

Route::prefix(config('auth-manager.routes.auth.prefix'))->group(function () {
    Route::post(config('auth-manager.routes.auth.login'), LoginController::class);
    Route::post(config('auth-manager.routes.auth.register'), RegisterController::class);
});
