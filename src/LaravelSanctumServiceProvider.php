<?php

namespace Mgcodeur\LaravelSanctum;

use Mgcodeur\LaravelSanctum\Commands\LaravelSanctumCommand;
use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasMigrations([
                'mg_sanctum_01_create_verifications_table',
                'mg_sanctum_02_create_social_accounts_table',
            ])
            ->hasCommand(LaravelSanctumCommand::class);

        $this->verifyManageableTrait();
    }

    public function verifyManageableTrait()
    {
        if (! LaravelSanctum::manageable()) {
            exit('You must use the: '.\Mgcodeur\LaravelSanctum\Traits\Manageable::class.' in your: '.config('auth-manager.auth.model').' Model');
        }
    }
}
