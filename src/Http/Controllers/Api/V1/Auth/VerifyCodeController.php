<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;

use Mgcodeur\LaravelSanctum\Http\Requests\Api\V1\Auth\VerifyOtpCodeRequest;

class VerifyCodeController
{
    /**
     * @OA\Post(
     *      path="/api/v1/auth/verify-code",
     *      tags={"Auth verification"},
     *      security={ {"sanctum": {} }},
     *      summary="Api Pour vérifier le code envoyée via OTP (Pour vérifier l'utilisateur)",
     *      description="Afin de vérifier l'utilisateur, il faut entrer le code reçu par email",
     *      @OA\Parameter(
     *         name="code",
     *         in="query",
     *         description="Le code reçu par email (Ex: 123456)",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent()
     *       )
     * )
     **/
    public function verify(VerifyOtpCodeRequest $request)
    {
        if (auth()->user()->email_verified_at) {
            return response()->json([
                'message' => 'Email already verified',
            ], 400);
        }

        if (auth()->user()->verifyOtpCode($request->code)) {
            return response()->json([
                'message' => 'Code verified successfully',
            ]);
        }
        abort(422, 'Code verification failed');
    }

    /**
     * @OA\Post(
     *      path="/api/v1/auth/resend-code",
     *      tags={"Auth verification"},
     *      summary="Api Resend Code (Re-envoye le code par email)",
     *      description="Re-envoye le code par email",
     *      security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent()
     *       )
     * )
     **/
    public function resend()
    {
        if (auth()->user()->email_verified_at) {
            return response()->json([
                'message' => 'Email already verified',
            ], 400);
        }

        auth()->user()->sendEmailVerificationCode();

        return response()->json([
            'message' => 'Code sent successfully',
        ], 200);
    }
}
