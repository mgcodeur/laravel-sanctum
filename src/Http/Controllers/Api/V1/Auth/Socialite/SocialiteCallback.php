<?php

namespace Mgcodeur\LaravelSanctum\Http\Controllers\Api\V1\Auth\Socialite;

use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;
use Mgcodeur\LaravelSanctum\Http\Resources\Api\Auth\LoginResource;
use Mgcodeur\LaravelSanctum\Models\SocialAccount;

class SocialiteCallback
{
    public function __invoke($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        return (new LoginResource($this->findOrCreateUser($user, $provider)))->additional([
            'message' => __('mg-sanctum::auth.success'),
        ]);
    }

    private function findOrCreateUser($user, $provider)
    {
        return LaravelSanctum::getAuthModel()::where('email', $user->email)
                ->whereHas('socialAccounts', function ($query) use ($provider) {
                    $query->where('provider', $provider);
                })
                ->firstOr(function () use ($user, $provider) {
                    $auth = LaravelSanctum::getAuthModel()::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'email_verified_at' => Carbon::now(),
                        'password' => bcrypt('password_default@@mg-sanctum'.time()),
                    ]);

                    SocialAccount::create([
                        'user_id' => $auth->id,
                        'provider' => $provider,
                        'provider_id' => $user->id,
                    ]);

                    return $auth;
                });
    }
}
