<?php

namespace Mgcodeur\LaravelSanctum\Traits;

use Illuminate\Support\Facades\Hash;

trait Manageable
{
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
