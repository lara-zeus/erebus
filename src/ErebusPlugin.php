<?php

namespace LaraZeus\Erebus;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;

final class ErebusPlugin implements Plugin
{
    use Configuration;
    use EvaluatesClosures;

    public function getId(): string
    {
        return 'zeus-erebus';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverClusters(in: __DIR__ . '/Filament/Clusters', for: 'LaraZeus\\Erebus\\Filament\\Clusters')
            ->resources([
                //
            ]);
    }

    public static function make(): static
    {
        return new self();
    }

    public static function get(): static
    {
        // @phpstan-ignore-next-line
        return filament('zeus-erebus');
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
