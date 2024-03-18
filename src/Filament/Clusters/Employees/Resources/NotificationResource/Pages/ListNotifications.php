<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\NotificationResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosListRecords;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\NotificationResource;

class ListNotifications extends ChaosListRecords
{
    protected static string $resource = NotificationResource::class;
}
