<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource\Pages;

use Filament\Forms\Components\Select;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosListRecords;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource;

class ListPermissions extends ChaosListRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getTableBulkActions(): array
    {
        $roleModel = config('permission.models.role');

        return [
            BulkAction::make('Attach Role')
                ->action(function (Collection $records, array $data): void {
                    foreach ($records as $record) {
                        /** @phpstan-ignore-next-line */
                        $record->roles()->sync($data['role']);
                        $record->save();
                    }
                })
                ->form([
                    Select::make('role')
                        ->label(__('filament-spatie-roles-permissions::filament-spatie.field.role'))
                        ->options($roleModel::query()->pluck('name', 'id'))
                        ->required(),
                ])->deselectRecordsAfterCompletion(),
        ];
    }
}
