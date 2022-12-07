<?php

namespace Mgcodeur\LaravelSanctum;

use Spatie\LaravelPackageTools\Package;
use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Mgcodeur\LaravelSanctum\Commands\LaravelSanctumCommand;

class LaravelSanctumServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('mg-sanctum')
            ->hasConfigFile('auth-manager')
            ->hasViews()
            ->hasRoute('api')
            ->hasTranslations()
            ->hasMigration('create_migration_for_auth_manager_auth')
            ->hasCommand(LaravelSanctumCommand::class);

        $this->verifyTrait();
    }

    public function verifyTrait() {
        if(!LaravelSanctum::manageable()) {
            throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json([
                "message" => "You must use the: ". \Mgcodeur\LaravelSanctum\Traits\Manageable::class ." in your: ". config('auth-manager.auth.model') ." Model"
            ], 500));
        }
    }
}
