<?php

namespace Mgcodeur\LaravelSanctum\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mgcodeur\LaravelSanctum\LaravelSanctumServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Mgcodeur\\LaravelSanctum\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelSanctumServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-sanctum_table.php.stub';
        $migration->up();
        */
    }
}
