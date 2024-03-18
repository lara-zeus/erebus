<?php

namespace LaraZeus\Erebus\Filament\Clusters\Employees\Resources;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Chaos\Filament\ChaosResource;
use LaraZeus\Chaos\Filament\ChaosResource\ChaosForms;
use LaraZeus\Chaos\Filament\ChaosResource\ChaosTables;
use LaraZeus\Erebus\Filament\Clusters\Employees;
use LaraZeus\Erebus\Filament\Clusters\Employees\Resources\UserResource\Pages;

class UserResource extends ChaosResource
{
    protected static ?string $cluster = Employees::class;

    protected static ?int $navigationSort = 1;

    public static function getModel(): string
    {
        return config('auth.providers.users.model');
    }

    public static function form(Form $form): Form
    {
        return ChaosForms::make($form, [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            TextInput::make('password')
                ->password()
                ->required()
                ->maxLength(255),

            Select::make('roles')
                ->dehydrated(false)
                ->relationship(
                    name: 'roles',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn (Builder $query) => $query
                        ->where('roles.company_id', tenant('id'))
                        ->orWhereNull('roles.company_id'),
                )
                ->saveRelationshipsUsing(function (Model $record, $state) {
                    // @phpstan-ignore-next-line
                    $record->roles()->syncWithPivotValues(
                        $state,
                        ['company_id' => getPermissionsTeamId()]
                    );
                })
                ->multiple()
                ->preload()
                ->searchable(),

            DateTimePicker::make('email_verified_at'),

            /*Select::make('current_company_id')
                ->relationship(
                    'currentCompany',
                    'name',
                    modifyQueryUsing: fn(Builder $query) => $query->where('user_id', auth()->user()->id)
                ),*/

            /*CuratorPicker::make('profile_photo_path')
                ->directory('user_profile_photo')
                ->label(fn () => static::langFile() . '.profile_photo_path')
                ->buttonLabel(fn () => static::langFile() . '.select_photo')
                ->columnSpanFull(),*/
        ]);
    }

    public static function table(Table $table): Table
    {
        return ChaosTables::make(
            static::class,
            $table,
            [
                ImageColumn::make('profile_photo_path')->circular(),
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('currentCompany.name'),
            ],
            filters: [
                Tables\Filters\Filter::make('from_social')
                    ->query(fn (Builder $query): Builder => $query->whereHas('ConnectedAccounts')),
                Tables\Filters\Filter::make('with_company')
                    ->query(fn (Builder $query): Builder => $query->whereHas('ownedCompanies')),
            ]
        )
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
