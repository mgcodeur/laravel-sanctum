<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;

class VerifyLinkController
{
    public function verify($token)
    {
        if (Carbon::now() > $this->getExpiration($token)) {
            exit('Link expired');
        }

        $user = LaravelSanctum::getAuthModel()::where('email', $this->getEmail($token))->first();
        if (! $user) {
            exit('User not found');
        }

        if ($user->email_verified_at) {
            exit('User already verified');
        }

        $user->email_verified_at = now();
        $user->save();

        //TODO: redirect user after verification
        dd('success');
    }

    private function getEmail($token)
    {
        return explode('-expiration:', Crypt::decryptString($token))[0];
    }

    private function getExpiration($token)
    {
        return explode('-expiration:', Crypt::decryptString($token))[1];
    }
}
