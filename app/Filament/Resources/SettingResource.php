<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Setting;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Navigation\NavigationItem;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Spatie\Translatable\HasTranslations;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\SettingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SettingResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function getPluralModelLabel(): string
    {
        return __('keys.settings');
    }

    public static function getModelLabel(): string
    {
        return __('keys.setting');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('keys.content_management');
    }
    public static function getNavigationUrl(): string
    {
        return static::getUrl('edit', ['record' => 1]);
    }
    #--------------------------------------------------------FORM
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name.en')
                    ->label(__('keys.name_en'))
                    ->required(),

                Forms\Components\TextInput::make('name.ar')
                    ->label(__('keys.name_ar'))
                    ->required(),

                Forms\Components\RichEditor::make('description.en')
                    ->label(__('keys.description_en'))
                    ->required(),

                Forms\Components\RichEditor::make('description.ar')
                    ->label(__('keys.description_ar'))
                    ->required(),

                Forms\Components\RichEditor::make('notes_and_suggestions.en')
                    ->label(__('keys.notes_and_suggestions_en'))
                    ->required(),

                Forms\Components\RichEditor::make('notes_and_suggestions.ar')
                    ->label(__('keys.notes_and_suggestions_ar'))
                    ->required(),

                Forms\Components\TextInput::make('email')->label(__('keys.email'))->email()->nullable(),
                Forms\Components\TextInput::make('phone')->label(__('keys.phone'))->nullable(),
                Forms\Components\TextInput::make('phone2')->label(__('keys.phone2'))->nullable(),
                Forms\Components\TextInput::make('support_phone')->label(__('keys.support_phone'))->nullable(),
                Forms\Components\TextInput::make('location')->label(__('keys.location'))->nullable(),
                Forms\Components\TextInput::make('facebook')->label(__('keys.facebook'))->url()->nullable(),
                Forms\Components\TextInput::make('x')->label(__('keys.twitter'))->url()->nullable(),
                Forms\Components\TextInput::make('instagram')->label(__('keys.instagram'))->url()->nullable(),
                Forms\Components\TextInput::make('whatsapp')->label(__('keys.whatsapp'))->url()->nullable(),
                Forms\Components\TextInput::make('youtube')->label(__('keys.youtube'))->url()->nullable(),
                Forms\Components\TextInput::make('tiktok')->label(__('keys.tiktok'))->url()->nullable()->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('logo')
                    ->label(__('keys.logo'))
                    ->collection('logo')
                    ->image()
                    ->imagePreviewHeight('250'),

                SpatieMediaLibraryFileUpload::make('logo2')
                    ->label(__('keys.logo2'))
                    ->collection('logo2')
                    ->image()
                    ->imagePreviewHeight('250'),

                SpatieMediaLibraryFileUpload::make('footer_image')
                    ->label(__('keys.footer_image'))
                    ->collection('footer_image')
                    ->image()
                    ->imagePreviewHeight('250'),

                SpatieMediaLibraryFileUpload::make('favicon')
                    ->label(__('keys.favicon'))
                    ->collection('favicon')
                    ->image()
                    ->imagePreviewHeight('250'),
            ]);
    }

    #--------------------------------------------------------TABLE
    public static function table(Table $table): Table
    {
        $locale = app()->getLocale();
        return $table
            ->columns([
                TextColumn::make('name')->label('Name (EN)')->sortable()->searchable(),

                TextColumn::make('email')->label('Email')->sortable()->searchable(),
                TextColumn::make('phone')->label('Phone')->sortable(),
                TextColumn::make('phone2')->label('Phone 2')->sortable(),
                TextColumn::make('support_phone')->label('Support Phone')->sortable(),

                TextColumn::make('location')->label('Location')->sortable(),

                TextColumn::make('facebook')->label('Facebook')->limit(30),
                TextColumn::make('x')->label('Twitter')->limit(30),
                TextColumn::make('instagram')->label('Instagram')->limit(30),
                TextColumn::make('whatsapp')->label('WhatsApp')->limit(30),
                TextColumn::make('youtube')->label('YouTube')->limit(30),
                TextColumn::make('tiktok')->label('TikTok')->limit(30),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d-m-Y H:i')->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d-m-Y H:i')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    #--------------------------------------------------------RELATIONS
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    #--------------------------------------------------------PAGES
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'view' => Pages\ViewSetting::route('/{record}'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
