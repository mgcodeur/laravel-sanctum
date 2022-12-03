<?php

use Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function() {
    Route::post('login', LoginController::class);
});
