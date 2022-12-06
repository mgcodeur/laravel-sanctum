<?php
namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;
use Mgcodeur\LaravelSanctum\Http\Requests\Api\V1\Auth\LoginRequest;
use Mgcodeur\LaravelSanctum\Http\Resources\Api\Auth\LoginResource;

class LoginController
{
    /**
    * @OA\Post(
    *      path="/api/v1/auth/login",
    *      tags={"Auth"},
    *      summary="Api Login (Pour connecter l'utilisateur au plateforme)",
    *      description="Retourne le token d'accès (à utiliser comme un bearer token)",
    *      @OA\Parameter(
    *         name="email",
    *         in="query",
    *         description="Votre adresse e-mail (Ex: mgcodeur@gmail.com)",
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
    public function __invoke(LoginRequest $request) {
        if(!auth()->attempt($request->only(['email', 'password']))) abort(400, __('mg-sanctum::auth.failed'));
        return (new LoginResource(auth()->user()))->additional([
            'message' => __('mg-sanctum::auth.success'),
        ]);
    }
}
