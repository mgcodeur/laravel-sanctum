<?php

namespace Mgcodeur\LaravelSanctum\Commands;

use Illuminate\Console\Command;

class LaravelSanctumCommand extends Command
{
    public $signature = 'laravel-sanctum';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
