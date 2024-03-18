<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources\RoleResource\RelationManager;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Chaos\Filament\ChaosResource\ChaosForms;
use LaraZeus\Chaos\Filament\ChaosResource\ChaosTables;

class UserRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    /*
     * Support changing tab title in RelationManager.
     */
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return 'users';
    }

    public function form(Form $form): Form
    {
        return ChaosForms::make($form, [
            TextInput::make('name')
                ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name')),
        ]);
    }

    public function table(Table $table): Table
    {
        return ChaosTables::make(
            static::class,
            $table,
            [
                TextColumn::make('name')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name'))
                    ->searchable(),
            ]
        )
            ->heading(__('filament-spatie-roles-permissions::filament-spatie.section.users'))
            ->headerActions([
                AttachAction::make(),
            ]);
    }
}
