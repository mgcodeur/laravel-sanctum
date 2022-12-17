<?php

return [
    'use_jobs' => true, //use queue and jobs for email verification,
    'routes' => [
        //prefix of routes
        'prefix' => 'api/v1',

        //routes for auth
        'auth' => [
            'prefix' => 'auth',
            'login' => 'login', //-> api/v1/auth/login (you can change the routes if you change prefix and feature_name in modules)
            'register' => 'register',
            'profile' => 'profile',
            'verify_link' => 'verify-link',
            'verify_code' => 'verify-code',
            'resend_link' => 'resend-link',
            'resend_code' => 'resend-code',

            'socialite' => [
                'redirect' => 'redirect',
                'callback' => 'callback',
            ],
        ],
    ],

    'auth' => [
        //model used for authentication
        'model' => App\Models\User::class,
        'table' => 'users',

        //user verification method
        'verification' => [
            'expire_in' => 3600, //in seconds
            'type' => 'otp', //possible value: otp, link
        ],
    ],
];
