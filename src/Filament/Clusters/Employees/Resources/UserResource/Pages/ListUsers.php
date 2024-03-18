<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\UserResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosListRecords;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\UserResource;

class ListUsers extends ChaosListRecords
{
    protected static string $resource = UserResource::class;
}
