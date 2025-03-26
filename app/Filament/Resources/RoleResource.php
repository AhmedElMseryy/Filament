<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use Spatie\Permission\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Spatie\Permission\Models\Permission;
use Filament\Forms\Components\Actions\Action; // ✅ الاستيراد الصحيح لـ Button
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    public static function getPluralModelLabel(): string
    {
        return __('keys.roles');
    }

    public static function getModelLabel(): string
    {
        return __('keys.role');
    }


    public static function getNavigationGroup(): ?string
    {
        return __('keys.user_management');
    }

    #------------------------------------------------------------------------------
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('keys.role_name'))
                    ->required()
                    ->unique(ignoreRecord: true),

                Section::make(__('keys.permissions'))
                    ->schema(
                        collect(Permission::all()->groupBy(function ($permission) {
                            return explode('_', $permission->name)[1] ?? 'General';
                        }))->map(function ($group, $key) {
                            return Section::make(__(ucwords(str_replace('_', ' ', $key))))
                                ->schema([
                                    CheckboxList::make("permissions.$key")
                                        ->label(__(ucwords(str_replace('_', ' ', $key))))
                                        ->options($group->pluck('name', 'id')->toArray())
                                        ->columns(3),
                                ])
                                ->extraAttributes([
                                    'class' => 'permissions-group',
                                    'data-group' => $key
                                ])
                                ->collapsible();
                        })->values()->toArray()
                    ),
                // زر "تحديد الكل" لكل المجموعات باستخدام JavaScript
                \Filament\Forms\Components\Placeholder::make('select_all_button')
                    ->content('<button type="button" id="selectAllBtn" class="px-4 py-2 bg-blue-500 text-white rounded">تحديد الكل</button>')
                    ->reactive(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('#')
                    ->label('#')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('keys.role_name'))
                    ->sortable()

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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
