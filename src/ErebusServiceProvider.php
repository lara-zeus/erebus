<?php

namespace LaraZeus\Erebus;

use LaraZeus\Erebus\Console\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ErebusServiceProvider extends PackageServiceProvider
{
    public static string $name = 'zeus-erebus';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasCommands([
                InstallCommand::class,
            ])
            ->hasTranslations();
    }
}
