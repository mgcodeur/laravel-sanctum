<?php
namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;
use Mgcodeur\LaravelSanctum\Http\Resources\Api\Auth\LoginResource;
use Mgcodeur\LaravelSanctum\Http\Requests\Api\V1\Auth\RegisterRequest;

class RegisterController
{
    public function __invoke(RegisterRequest $request)
    {
        $user = LaravelSanctum::getAuthModel()::create($request->all());

        return (new LoginResource($user))->additional([
            'message' => __('mg-sanctum::auth.success'),
        ]);
    }
}
