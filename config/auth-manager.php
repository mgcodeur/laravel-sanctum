<?php

return [
    "routes" => [
        //prefix of routes
        "prefix" => "api/v1",

        //for auth module
        "auth" => [
            "prefix" => "auth",
            "login" => "login", //-> api/v1/auth/login (you can change the routes if you change prefix and feature in modules)
            "register" => "register"
        ]
    ],

    "auth" => [
        //model used by auth
        "model" => App\Models\User::class,
        "table" => 'users'
    ]
];
