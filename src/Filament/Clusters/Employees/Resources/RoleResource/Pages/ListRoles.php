<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\RoleResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosListRecords;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\RoleResource;

class ListRoles extends ChaosListRecords
{
    protected static string $resource = RoleResource::class;
}
