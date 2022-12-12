<?php

namespace Mgcodeur\LaravelSanctum\Traits;
use Illuminate\Support\Facades\Hash;
use Mgcodeur\LaravelSanctum\Models\OtpCode;

trait Manageable
{
    use Verifiable;
    /**
     * Models setters.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Models relationships.
     */
    public function otpCode()
    {
        return $this->hasOne(OtpCode::class);
    }
}
