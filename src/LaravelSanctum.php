<?php

namespace Mgcodeur\LaravelSanctum;

class LaravelSanctum
{
    public function getAuthModel()
    {
        return config('auth-manager.auth.model');
    }
}
