<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;

use Mgcodeur\LaravelSanctum\Http\Requests\Api\V1\Auth\VerifyOtpCodeRequest;

class VerifyCodeController
{
    public function verify(VerifyOtpCodeRequest $request)
    {
        if(auth()->user()->email_verified_at)
            return response()->json([
                'message' => 'Email already verified'
            ], 200);

        if(auth()->user()->verifyOtpCode($request->code)) return response()->json([
            'message' => 'Code verified successfully'
        ]);
        abort(422, 'Code verification failed');
    }
}
