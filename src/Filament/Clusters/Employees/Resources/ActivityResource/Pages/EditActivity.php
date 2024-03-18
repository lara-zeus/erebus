<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\ActivityResource\Pages;

use Filament\Actions;
use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosEditRecord;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\ActivityResource;

class EditActivity extends ChaosEditRecord
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
