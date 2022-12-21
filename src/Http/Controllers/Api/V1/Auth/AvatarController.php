<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;
use Mgcodeur\LaravelSanctum\Models\Media;

class AvatarController
{
    /**
     * @OA\Post(
     *      path="/api/v1/auth/avatar",
     *      tags={"Auth"},
     *      security={ {"sanctum": {} }},
     *      summary="Api pour mettre à jour l'avatar de l'utilisateur",
     *      description="Retourne un message de succès",
     *      operationId="updateAvatar",
     *      @OA\MediaType(mediaType="multipart/form-data"),
     *      @OA\Parameter(
     *         name="accept",
     *         in="header",
     *         description="Pour accepter les donnée multipart (à envoyer dans le header)",
     *         @OA\Schema(
     *             type="string",
     *             default="multipart/form-data"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_method",
     *         in="query",
     *         description="Pour accepter les donnée multipart (body à envoyer)",
     *         @OA\Schema(
     *             type="string",
     *             default="put"
     *         )
     *     ),
     *     @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                  property="avatar",
     *                  type="array",
     *                  @OA\Items(
     *                       type="string",
     *                       format="binary",
     *                  ),
     *               ),
     *           ),
     *       )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      ),
     * )
     **/
    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json([
                "data" => $validator->errors()
            ]);
        }

        $fileName = uniqid().'.'.$request->file('avatar')->getClientOriginalName();
        $request->file('avatar')->storeAs('', $fileName, 'avatar');
        $fullPath = Storage::disk('avatar')->getConfig()["url"].'/'.$fileName;

        Media::create(
            [
                "name" => $fileName,
                "mediable_type" => LaravelSanctum::getAuthModel(),
                "mediable_id" => auth()->user()->id,
                "group" => "avatar",
                "disk" => "avatar",
                "full_path" => $fullPath
            ]
        );

        auth()->user()->update([
            "avatar" => $fullPath
        ]);

        return response()->json([
            'message' => 'Avatar updated successfully'
        ]);
    }
}
