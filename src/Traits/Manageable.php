<?php

namespace Mgcodeur\LaravelSanctum\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Mgcodeur\LaravelSanctum\Jobs\Api\V1\Auth\AuthEmailVerificationLink;
use Mgcodeur\LaravelSanctum\Mail\Api\Auth\SendVerificationLink;

trait Manageable
{
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function sendEmailVerificationLink()
    {
        match (config('auth-manager.use_jobs')) {
            true => AuthEmailVerificationLink::dispatch($this),
            false => Mail::to($this->email)->send(new SendVerificationLink($this)),
        };
    }

    public function generateVerificationHash()
    {
        return Crypt::encryptString($this->email.'-expiration:'.Carbon::now()->addSecond(config('auth-manager.auth.verification.expire_in')));
    }

    public function generateVerificationLink()
    {
        return env('APP_URL').'/'.config('auth-manager.routes.prefix')
        .'/'.config('auth-manager.routes.auth.prefix').'/'
        .config('auth-manager.routes.auth.verify_link').'/'
        .$this->generateVerificationHash();
    }
}
