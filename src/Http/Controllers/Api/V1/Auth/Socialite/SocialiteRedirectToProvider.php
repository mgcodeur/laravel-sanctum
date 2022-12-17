<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth\Socialite;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteRedirectToProvider
{
    public function __invoke(Request $request, $provider)
    {
        $redirectUrl = Socialite::driver($provider)
            ->stateless()
            ->redirectUrl($request->input('redirect_url'))
            ->redirect()
            ->getTargetUrl();

        return response()->json([
            'data' => [
                'redirect_url' => $redirectUrl,
            ],
        ]);
    }
}
