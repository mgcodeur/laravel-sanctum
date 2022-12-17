<?php

namespace Mgcodeur\LaravelSanctum\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class LaravelSanctumCommand extends Command
{
    public $signature = 'mg-sanctum:install';

    public $description = 'MgCodeur Laravel Sanctum Install command';

    public function handle(): int
    {
        Artisan::call('vendor:publish --tag=mg-sanctum-config');
        $this->info('Config published in /config/auth-manager.php');
        Artisan::call('vendor:publish --tag=mg-sanctum-migrations');
        $this->info('Migration published in /database/migrations');

        return self::SUCCESS;
    }
}
