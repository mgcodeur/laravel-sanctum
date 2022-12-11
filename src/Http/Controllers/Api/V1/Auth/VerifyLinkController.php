<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;

class VerifyLinkController
{
    public function verify($token)
    {
        if(LaravelSanctum::getAuthModel()::VerifyUserLink($token)) return response()->json([
            'message' => 'Email verified successfully'
        ]);
        abort(400, 'Email verification failed');
    }
}
