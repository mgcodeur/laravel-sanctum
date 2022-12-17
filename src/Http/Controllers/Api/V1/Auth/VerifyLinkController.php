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

    /**
     * @OA\Post(
     *      path="/api/v1/auth/resend-link",
     *      tags={"Auth"},
     *      summary="Api Pour Re-envoyer le lien de confirmation via e-mail (Afin que l'utilisateur puisse confirmer son email)",
     *      description="Afin que l'utilisateur puisse confirmer son email, il faut re-envoyer le lien de confirmation si l'utilisateur n'a pas reçu le lien de confirmation",
     *      @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="cliquer sur le lien de confirmation ou l'ouvrir dans un onglet du navigateur",
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
    public function resend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = LaravelSanctum::getAuthModel()::where('email', $request->email)->first();
        if (! $user) {
            return response()->json([
                'message' => 'User not found',
            ], 400);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified',
            ], 400);
        }

        if (! $user) {
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
