<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;

class VerifyLinkController
{
    public function verify($token)
    {
        if (LaravelSanctum::getAuthModel()::VerifyUserLink($token)) {
            return response()->json([
                'message' => 'Email verified successfully',
            ]);
        }
        abort(400, 'Email verification failed');
    }

    public function resend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = LaravelSanctum::getAuthModel()::where('email', $request->email)->first();

        if($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified',
            ], 400);
        }

        if(!$user)
        {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $user->sendEmailVerificationLink();

        return response()->json([
            'message' => 'Email verification link sent',
        ], 200);
    }
}
