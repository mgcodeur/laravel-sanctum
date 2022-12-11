<?php

namespace Mgcodeur\LaravelSanctum\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;
use Mgcodeur\LaravelSanctum\Jobs\Api\V1\Auth\AuthEmailVerificationCode;
use Mgcodeur\LaravelSanctum\Mail\Api\Auth\SendVerificationCode;
use Mgcodeur\LaravelSanctum\Models\OtpCode;
use Mgcodeur\LaravelSanctum\Mail\Api\Auth\SendVerificationLink;
use Mgcodeur\LaravelSanctum\Jobs\Api\V1\Auth\AuthEmailVerificationLink;

trait Manageable
{
    /**
     * Models setters.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Verification link helpers.
     */
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

    public static function VerifyUserLink($token)
    {
        if (Carbon::now() > self::getHashExpiration($token)) {
            exit('Link expired');
        }

        $user = LaravelSanctum::getAuthModel()::where('email', self::getHashEmail($token))->first();

        if (! $user)
        {
            exit('User not found');
        }

        if ($user->email_verified_at)
        {
            exit('User already verified');
        }

        $user->email_verified_at = now();
        $user->save();

        return true;
    }

    /**
     * Verification code (otp) helpers.
     */
    public function generateVerificationCode()
    {
        $code = random_int(100000, 999999);
        $this->otpCode()->create([
            'code' => $code,
            'user_id' => $this->id,
            'expired_at' => Carbon::now()->addSecond(config('auth-manager.auth.verification.expire_in'))
        ]);
        return $code;
    }

    public function verifyOtpCode($code)
    {
        if(!$this->otpCode()->count()) return false;
        if(!$this->otpCode->code === $code || Carbon::now() > $this->otpCode->expired_at || $this->email_verified_at) return false;

        $this->email_verified_at = now();
        $this->save();

        $this->otpCode()->delete();

        return true;
    }

    public function sendEmailVerificationCode()
    {
        match (config('auth-manager.use_jobs')) {
            true => AuthEmailVerificationCode::dispatch($this),
            false => Mail::to($this->email)->send(new SendVerificationCode($this)),
        };
    }

    /**
     * Models relationships.
     */
    public function otpCode()
    {
        return $this->hasOne(OtpCode::class);
    }


    /**
     * Models Helpers.
     */
    private static function getHashExpiration($token)
    {
        return explode('-expiration:', Crypt::decryptString($token))[1];
    }

    private static function getHashEmail($token)
    {
        return explode('-expiration:', Crypt::decryptString($token))[0];
    }
}
