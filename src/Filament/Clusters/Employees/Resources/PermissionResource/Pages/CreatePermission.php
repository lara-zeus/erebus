<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosCreateRecord;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource;

class CreatePermission extends ChaosCreateRecord
{
    protected static string $resource = PermissionResource::class;
}
