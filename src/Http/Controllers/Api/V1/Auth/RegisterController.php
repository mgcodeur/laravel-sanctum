<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;

use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;
use Mgcodeur\LaravelSanctum\Http\Requests\Api\V1\Auth\RegisterRequest;
use Mgcodeur\LaravelSanctum\Http\Resources\Api\Auth\LoginResource;

class RegisterController
{
    /**
     * @OA\Post(
     *      path="/api/v1/auth/register",
     *      tags={"Auth"},
     *      summary="Api Register (Pour inscrire l'utilisateur au plateforme)",
     *      description="Retourne le token d'accès (à utiliser comme un bearer token)",
     *      @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Votre nom (Ex: John)",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *      ),
     *      @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Votre adresse email (Ex: mgcodeur@gmail.com)",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *      ),
     *      @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Votre mot de passe (Ex: password)",
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
    public function __invoke(RegisterRequest $request)
    {
        $user = LaravelSanctum::getAuthModel()::create($request->all());

        return (new LoginResource($user))->additional([
            'message' => __('mg-sanctum::auth.success'),
        ]);
    }
}
