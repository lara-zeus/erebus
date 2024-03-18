<?php

namespace LaraZeus\Erebus\Filament\Clusters;

use Filament\Clusters\Cluster;

class Employees extends Cluster
{
    protected static ?string $navigationIcon = 'tabler-point-filled';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('zeus-erebus::erebus.employees_cluster_label');
    }
}
