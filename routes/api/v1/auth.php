<?php

use Illuminate\Support\Facades\Route;
use Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth\LoginController;

Route::prefix('auth')->group(function () {
    Route::post('login', LoginController::class);
});
