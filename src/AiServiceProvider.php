<?php

namespace JordanDalton\LaravelAI;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use JordanDalton\LaravelAI\Commands\SkeletonCommand;

class AiServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $this->app->singleton('ai', fn($app) => new AiManager($app));
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ai')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_migration_table_name_table')
            ->hasCommand(SkeletonCommand::class);
    }
}
