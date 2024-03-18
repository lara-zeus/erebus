<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\UserResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosCreateRecord;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\UserResource;

class CreateUser extends ChaosCreateRecord
{
    protected static string $resource = UserResource::class;
}
