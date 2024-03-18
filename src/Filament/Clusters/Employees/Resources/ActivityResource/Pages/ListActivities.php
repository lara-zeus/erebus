<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\ActivityResource\Pages;

use Filament\Actions;
use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosListRecords;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\ActivityResource;

class ListActivities extends ChaosListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
