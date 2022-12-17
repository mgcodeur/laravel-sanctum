<?php

namespace Mgcodeur\LaravelSanctum\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Mgcodeur\LaravelSanctum\Jobs\Api\V1\Auth\AuthEmailVerificationCode;
use Mgcodeur\LaravelSanctum\Jobs\Api\V1\Auth\AuthEmailVerificationLink;
use Mgcodeur\LaravelSanctum\Mail\Api\Auth\SendVerificationCode;
use Mgcodeur\LaravelSanctum\Mail\Api\Auth\SendVerificationLink;
use Mgcodeur\LaravelSanctum\Models\Verification;

trait Verifiable
{
    /**
     * @return MorphOne
     */
    public function verification(): MorphOne
    {
        return $this->morphOne(Verification::class, 'verifiable');
    }

    /** Verification link helpers. **/
    /**
     * @return void
     */
    public function sendEmailVerificationLink()
    {
        if (! $this->hasVerifiedEmail()) {
            match (config('auth-manager.use_jobs')) {
                true => AuthEmailVerificationLink::dispatch($this),
                false => Mail::to($this->email)->send(new SendVerificationLink($this)),
            };
        }
    }

    /**
     * @return string
     */
    public function generateVerificationHash()
    {
        if ($this->verification()->exists()) {
            $this->verification->delete();
        }

        $verification = Verification::create([
            'verifiable_id' => $this->id,
            'verifiable_type' => get_class($this),
            'name' => 'email_hash',
            'content' => Crypt::encryptString($this->email),
            'expires_at' => Carbon::now()->addSecond(config('auth-manager.auth.verification.expire_in')),
        ]);

        return $verification->content;
    }

    /**
     * @return string
     */
    public function generateVerificationLink()
    {
        return env('APP_URL').'/'.config('auth-manager.routes.prefix')
            .'/'.config('auth-manager.routes.auth.prefix').'/'
            .config('auth-manager.routes.auth.verify_link').'/'
            .$this->generateVerificationHash();
    }

    /**
     * @param  string  $token
     * @return bool|void
     */
    public static function VerifyUserLink(string $token)
    {
        $verification = Verification::where('content', $token)->first();

        if (Carbon::now()->greaterThan($verification->expires_at)) {
            exit('Link expired');
        }

        $user = self::where('email', Crypt::decryptString($verification->content))->first();

        if (! $user) {
            exit('User not found');
        }

        if ($user->email_verified_at) {
            exit('User already verified');
        }

        $user->email_verified_at = now();
        $user->save();

        $user->verification()->delete();

        return true;
    }

    /** Verification code (otp) helpers. **/
    public function generateVerificationCode(): string
    {
        if ($this->verification()->exists()) {
            $this->verification->delete();
        }

        $code = random_int(100000, 999999);

        $verification = Verification::create([
            'verifiable_id' => $this->id,
            'verifiable_type' => get_class($this),
            'name' => 'otp_hash',
            'content' => Crypt::encryptString($code),
            'expires_at' => Carbon::now()->addSecond(config('auth-manager.auth.verification.expire_in')),
        ]);

        return Crypt::decryptString($verification->content);
    }

    public function verifyOtpCode($code): bool
    {
        if (! $this->verification()->exists()) {
            return false;
        }

        if (
            ! Crypt::decryptString($this->verification->content) === $code ||
            Carbon::now()->greaterThan($this->verification->expired_at) ||
            $this->email_verified_at
        ) {
            return false;
        }

        $this->email_verified_at = now();
        $this->save();

        $this->verification()->delete();

        return true;
    }

    public function sendEmailVerificationCode(): void
    {
        if (! $this->hasVerifiedEmail()) {
            match (config('auth-manager.use_jobs')) {
                true => AuthEmailVerificationCode::dispatch($this),
                false => Mail::to($this->email)->send(new SendVerificationCode($this)),
            };
        }
    }
}
