<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosViewRecord;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource;

class ViewPermission extends ChaosViewRecord
{
    protected static string $resource = PermissionResource::class;
}
