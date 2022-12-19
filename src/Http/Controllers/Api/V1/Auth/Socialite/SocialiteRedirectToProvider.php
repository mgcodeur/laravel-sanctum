<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth\Socialite;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteRedirectToProvider
{
    /**
     * @OA\Post(
     *      path="/api/v1/auth/redirect",
     *      tags={"Socialite"},
     *      summary="Api Socialite Redirect (Pour rediriger l'utilisateur vers le provider, NB: provider = facebook, google, twitter, linkedin)",
     *      description="Retourn le lien de redirection vers le provider",
     *      @OA\Parameter(
     *         name="provider",
     *         in="query",
     *         description="Le provider (Ex: facebook, google, github)",
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
    public function __invoke(Request $request)
    {
        $validator = validator($request->all(), [
            'provider' => 'required|string|in:github,google,facebook',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $redirectUrl = Socialite::driver($request->input('provider'))
            ->stateless()
            ->redirect()
            ->getTargetUrl();

        return response()->json([
            'data' => [
                'redirect_url' => $redirectUrl,
            ],
        ]);
    }
}
