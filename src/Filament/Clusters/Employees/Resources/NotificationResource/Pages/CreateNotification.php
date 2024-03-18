<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\NotificationResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosCreateRecord;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\NotificationResource;

class CreateNotification extends ChaosCreateRecord
{
    protected static string $resource = NotificationResource::class;
}
