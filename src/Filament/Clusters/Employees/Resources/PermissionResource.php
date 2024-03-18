<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources;

use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use LaraZeus\Chaos\Filament\ChaosResource;
use LaraZeus\Chaos\Filament\ChaosResource\ChaosForms;
use LaraZeus\Chaos\Filament\ChaosResource\ChaosTables;
use LaraZeus\Erebus\Filament\Clusters\Employees;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource\Pages;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\PermissionResource\RelationManager\RoleRelationManager;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionResource extends ChaosResource
{
    protected static bool $isScopedToTenant = false;

    protected static ?string $cluster = Employees::class;

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return tenant() === null;
    }

    public static function getModel(): string
    {
        return config('permission.models.permission');
    }

    public static function form(Form $form): Form
    {
        return ChaosForms::make($form, [
            Section::make()
                ->schema([
                    TextInput::make('name')
                        ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name'))
                        ->required(),

                    Hidden::make('guard_name')->default('web')
                        ->dehydrateStateUsing(fn (string $state): string => 'web'),

                    Select::make('roles')
                        ->multiple()
                        ->label(__('filament-spatie-roles-permissions::filament-spatie.field.roles'))
                        ->relationship(
                            name: 'roles',
                            titleAttribute: 'name',
                            modifyQueryUsing: function (Builder $query, Get $get) {
                                if (! empty($get('guard_name'))) {
                                    $query->where('guard_name', $get('guard_name'));
                                }
                                if (Filament::hasTenancy()) {
                                    return $query->where(
                                        config('permission.column_names.team_foreign_key'),
                                        tenant('id')
                                    );
                                }

                                return $query;
                            }
                        )
                        ->preload(),
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
                TextColumn::make('name')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name'))
                    ->searchable(),
                TextColumn::make('guard_name')
                    ->toggleable(isToggledHiddenByDefault: config(
                        'filament-spatie-roles-permissions.toggleable_guard_names.permissions.isToggledHiddenByDefault',
                        true
                    ))
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name'))
                    ->searchable(),
            ],
            bulkActions: [
                BulkAction::make('Attach to roles')
                    ->action(function (Collection $records, array $data): void {
                        Role::whereIn('id', $data['roles'])
                            ->each(function (Role $role) use ($records): void {
                                // @phpstan-ignore-next-line
                                $records->each(function (Permission $permission) use ($role) {
                                    return $role->givePermissionTo($permission);
                                });
                            });
                    })
                    ->form([
                        Select::make('roles')
                            ->multiple()
                            ->label(__('filament-spatie-roles-permissions::filament-spatie.field.role'))
                            ->options(Role::query()->pluck('name', 'id'))
                            ->required(),
                    ])->deselectRecordsAfterCompletion(),
            ],
            filters: [
                /*SelectFilter::make('models')
                    ->label('Models')
                    ->multiple()
                    ->options(function () {
                        $commands = new \Althinect\FilamentSpatieRolesPermissions\Commands\Permission();

                        /** @var ReflectionClass[] * /
                        $models = $commands->getAllModels();

                        $options = [];

                        foreach ($models as $model) {
                            $options[$model->getShortName()] = $model->getShortName();
                        }

                        return $options;
                    })
                    ->query(function (Builder $query, array $data) {
                        if (isset($data['values'])) {
                            $query->where(function (Builder $query) use ($data) {
                                foreach ($data['values'] as $key => $value) {
                                    if ($value) {
                                        $query->orWhere(
                                            'name',
                                            'like',
                                            eval(config('filament-spatie-roles-permissions.model_filter_key'))
                                        );
                                    }
                                }
                            });
                        }

                        return $query;
                    }),*/
            ]
        )
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RoleRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
            'view' => Pages\ViewPermission::route('/{record}'),
        ];
    }
}
