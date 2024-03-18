<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\ActivityResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosCreateRecord;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\ActivityResource;

class CreateActivity extends ChaosCreateRecord
{
    protected static string $resource = ActivityResource::class;
}
