<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use LaraZeus\Chaos\Filament\ChaosResource;
use LaraZeus\Chaos\Filament\ChaosResource\ChaosTables;
use LaraZeus\Erebus\ErebusPlugin;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\NotificationResource\Pages;

class NotificationResource extends ChaosResource
{
    protected static bool $isScopedToTenant = true;

    protected static bool $shouldRegisterNavigation = false;

    public static function getModel(): string
    {
        return ErebusPlugin::get()->getModel('Notification');
    }

    public static function table(Table $table): Table
    {
        return ChaosTables::make(
            static::class,
            $table,
            [
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('data.title')->label(__('Title')),
                TextColumn::make('data.body')->label(__('Body')),
                TextColumn::make('read_at')
                    ->dateTime()
                    ->sortable(),
            ]
        );
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotifications::route('/'),
        ];
    }
}
