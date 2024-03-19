<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources;

use Filament\Facades\Filament;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Unique;
use LaraZeus\Chaos\Filament\ChaosResource;
use LaraZeus\Chaos\Filament\ChaosResource\ChaosForms;
use LaraZeus\Chaos\Filament\ChaosResource\ChaosTables;
use LaraZeus\Chaos\Forms\Components\MultiLang;
use LaraZeus\Erebus\Filament\Clusters\Employees;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\RoleResource\Pages;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\RoleResource\RelationManager\PermissionRelationManager;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\RoleResource\RelationManager\UserRelationManager;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleResource extends ChaosResource
{
    protected static ?string $cluster = Employees::class;

    protected static ?int $navigationSort = 2;

    public static function getModel(): string
    {
        return config('permission.models.role', Role::class);
    }

    public static function form(Form $form): Form
    {
        return ChaosForms::make($form, [
            Section::make()
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Hidden::make('guard_name')->default('web'),
                            MultiLang::make('name')
                                ->required()
                                ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule) {
                                    // If using teams and Tenancy, ensure uniqueness against current tenant
                                    if (config('permission.teams', false) && Filament::hasTenancy()) {
                                        // Check uniqueness against current user/team
                                        $rule->where(
                                            config('permission.column_names.team_foreign_key', 'team_id'),
                                            // @phpstan-ignore-next-line
                                            tenant('id')
                                        );
                                    }

                                    return $rule;
                                }),

                            Select::make('permissions')
                                ->columnSpanFull()
                                ->multiple()
                                ->relationship(
                                    name: 'permissions',
                                    modifyQueryUsing: fn (Builder $query) => $query->orderBy('name')->orderBy('name'),
                                )
                                ->getOptionLabelFromRecordUsing(fn (Permission $record) => $record->name)
                                ->searchable(['name'])
                                ->preload(),

                            // todo
                            /*Select::make(config('permission.column_names.team_foreign_key', 'team_id'))
                                ->hidden(fn () => ! config('permission.teams', false) || Filament::hasTenancy())
                                ->options(fn () => \LaraZeus\Tartarus\Models\Company::pluck('name', 'id'))
                                ->dehydrated(fn ($state) => (int) $state > 0),*/
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return ChaosTables::make(
            static::class,
            $table,
            [
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('name.' . app()->getLocale())
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name'))
                    ->searchable(),
                TextColumn::make('permissions_count')
                    ->counts('permissions')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.permissions_count'))
                    ->toggleable(isToggledHiddenByDefault: config(
                        'filament-spatie-roles-permissions.toggleable_guard_names.roles.isToggledHiddenByDefault',
                        true
                    )),
                TextColumn::make('guard_name')
                    ->toggleable(isToggledHiddenByDefault: config(
                        'filament-spatie-roles-permissions.toggleable_guard_names.roles.isToggledHiddenByDefault',
                        true
                    ))
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name'))
                    ->searchable(),
            ]
        )
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PermissionRelationManager::class,
            UserRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
            'view' => Pages\ViewRole::route('/{record}'),
        ];
    }
}
