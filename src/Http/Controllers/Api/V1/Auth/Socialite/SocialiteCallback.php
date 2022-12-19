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
        //find user by email
        $authUser = LaravelSanctum::getAuthModel()::where('email', $user->email)->first();

        if ($authUser) {
            $authUser->socialAccounts()->updateOrCreate(
                [
                    'user_id' => $authUser->id,
                    'provider' => $provider,
                    'provider_id' => $user->id,
                ]
            );
        }
        else {
            $authUser = LaravelSanctum::getAuthModel()::create([
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt($user->id),
            ]);

            SocialAccount::create([
                'user_id' => $authUser->id,
                'provider_id' => $user->id,
                'provider' => $provider,
            ]);
        }
        return $authUser;
    }
}
