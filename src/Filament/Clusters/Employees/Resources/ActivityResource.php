<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources;

use LaraZeus\Erebus\Filament\Clusters\Employees;

class ActivityResource extends \Z3d0X\FilamentLogger\Resources\ActivityResource
{
    protected static ?string $cluster = Employees::class;

    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return null;
    }

    public static function getNavigationIcon(): string
    {
        return 'tabler-point-filled';
    }
}
