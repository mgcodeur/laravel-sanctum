<?php

namespace Mgcodeur\LaravelSanctum\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mgcodeur\LaravelSanctum\LaravelSanctum
 */
class LaravelSanctum extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mgcodeur\LaravelSanctum\LaravelSanctum::class;
    }
}
