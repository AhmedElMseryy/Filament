<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use App\Filament\Resources\EmployeeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmployeeResource\RelationManagers;

class EmployeeResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getPluralModelLabel(): string
    {
        return __('keys.employees');
    }

    public static function getModelLabel(): string
    {
        return __('keys.employee');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('keys.user_management');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('keys.name'))
                    ->required(),

                TextInput::make('email')
                    ->label(__('keys.email'))
                    ->email()
                    ->unique('users', 'email')
                    ->required(),

                TextInput::make('phone')
                    ->label(__('keys.phone'))
                    ->tel(),

                TextInput::make('password')
                    ->label(__('keys.password'))
                    ->password()
                    ->visibleOn('create')
                    ->required(),


                Select::make('role_id')
                    ->label(__('keys.role'))
                    ->options(Role::all()->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),

                Toggle::make('is_active')
                    ->label(__('keys.active'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('keys.name'))->sortable()->searchable(),
                TextColumn::make('email')->label(__('keys.email'))->sortable()->searchable(),
                TextColumn::make('phone')->label(__('keys.phone'))->sortable()->searchable(),
                TextColumn::make('roles.name')->label(__('keys.role'))->badge(),
                ToggleColumn::make('is_active')->label(__('keys.active')),
                TextColumn::make('created_at')->label(__('keys.created_at'))->date('Y M d'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
