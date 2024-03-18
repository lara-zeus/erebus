<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\UserResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosEditRecord;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\UserResource;

class EditUser extends ChaosEditRecord
{
    protected static string $resource = UserResource::class;
}
