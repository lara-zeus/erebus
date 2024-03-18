<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosEditRecord;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource;

class EditPermission extends ChaosEditRecord
{
    protected static string $resource = PermissionResource::class;
}
