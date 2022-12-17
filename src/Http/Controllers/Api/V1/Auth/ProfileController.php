<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Mgcodeur\LaravelSanctum\Http\Requests\Api\V1\Auth\UpdateProfileRequest;
use Mgcodeur\LaravelSanctum\Http\Requests\Api\V1\Auth\VerifyOtpCodeRequest;

class ProfileController
{
    /**
     * @OA\Get(
     *      path="/api/v1/auth/profile",
     *      tags={"Auth"},
     *      security={ {"sanctum": {} }},
     *      summary="Api get profile  (Pour getter les informations de l'utilisateur)",
     *      description="Retourne les informations de l'utilisateur",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      ),
     * )
     **/
    public function me()
    {
        return response()->json([
            'data' => auth()->user(),
        ]);
    }

    /**
     * @OA\Put(
     *      path="/api/v1/auth/profile",
     *      tags={"Auth"},
     *      security={ {"sanctum": {} }},
     *      summary="Api update profile (Pour modifier le profile de l'utilisateur)",
     *      description="Retourne les informations de l'utilisateur une fois modifié",
     *
     *      @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Votre Nom Complet (Ex: Jimmy Raphaël)",
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
    public function update(UpdateProfileRequest $request)
    {
        auth()->user()->update($request->except(['password', 'email', 'avatar']));

        return response()->json([
            'message' => 'Modification effectué avec succès',
        ], 201);
    }
}
