<?php
use Illuminate\Support\Facades\Route;

Route::prefix(config('auth-manager.routes.prefix'))->group(function() {
    /**
     * all routes for api v1
     */
    require_once('v1/auth.php');
});
