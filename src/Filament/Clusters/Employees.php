<?php

namespace LaraZeus\Erebus\Filament\Clusters;

use Filament\Clusters\Cluster;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class Employees extends Cluster
{
    protected static ?string $navigationIcon = 'tabler-point-filled';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('zeus-erebus::erebus.employees_cluster_label');
    }

    public static function getClusterBreadcrumb(): ?string
    {
        return __('zeus-erebus::erebus.employees_cluster_label');
    }
}
