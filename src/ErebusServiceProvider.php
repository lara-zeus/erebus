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
            ->hasMigrations($this->getMigrations())
            ->hasCommands([
                InstallCommand::class,
            ])
            ->hasViews()
            ->hasTranslations();
    }

    protected function getMigrations(): array
    {
        return [
            'add_actions_by_to_users_table',
            'create_breezy_tables',
            'create_connected_accounts_table',
            'create_permission_tables',
            'create_activity_log_table',
            'add_event_column_to_activity_log_table',
            'add_batch_uuid_column_to_activity_log_table',
        ];
    }
}
