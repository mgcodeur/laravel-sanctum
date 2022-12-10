<?php

return [
    'routes' => [
        //prefix of routes
        'prefix' => 'api/v1',

        //for auth module
        'auth' => [
            'prefix' => 'auth',
            'login' => 'login', //-> api/v1/auth/login (you can change the routes if you change prefix and feature_name in modules)
            'register' => 'register',
            'profile' => 'profile',
            'verify_link' => 'verify-link',
        ],
    ],

    'auth' => [
        //model used by auth
        'model' => App\Models\User::class,
        'table' => 'users',

        //user verification method
        'verification' => [
            'expire_in' => 3600,
            'use_jobs' => true, //use queue and jobs for email verification
            // choose only one
            'type' => [
                'link' => true, //send a link
                'otp' => false, //send a code with customisable length to user
            ],
        ],
    ],
];
