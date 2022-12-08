<?php

namespace Mgcodeur\LaravelSanctum;

class LaravelSanctum
{
    public function getAuthModel()
    {
        return config('auth-manager.auth.model');
    }

    public function manageable()
    {
        if (! $this->getAuthModel()) {
            return true;
        }

        return array_key_exists(
            \Mgcodeur\LaravelSanctum\Traits\Manageable::class,
            class_uses($this->getAuthModel())
        );
    }
}
