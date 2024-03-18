<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource\RelationManager;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RoleRelationManager extends RelationManager
{
    protected static string $relationship = 'roles';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name')),
            TextInput::make('guard_name')
                ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name')),

        ]);
    }

    public function table(Table $table): Table
    {
        return $table->columns(
            [
                TextColumn::make('name')
                    ->searchable()
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name')),
                TextColumn::make('guard_name')
                    ->searchable()
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name')),
            ]
        )
            ->heading(__('filament-spatie-roles-permissions::filament-spatie.section.roles'));
    }
}
