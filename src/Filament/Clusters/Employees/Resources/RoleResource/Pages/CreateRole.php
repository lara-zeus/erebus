<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\RoleResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosCreateRecord;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\RoleResource;

class CreateRole extends ChaosCreateRecord
{
    protected static string $resource = RoleResource::class;
}
