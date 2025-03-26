<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\About;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\AboutResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AboutResource\RelationManagers;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralModelLabel(): string
    {
        return __('keys.abouts');
    }

    public static function getModelLabel(): string
    {
        return __('keys.about');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('keys.content_management');
    }

    #--------------------------------------------------------FORM

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name.en')
                    ->label(__('keys.name_en'))
                    ->required(),

                TextInput::make('name.ar')
                    ->label(__('keys.name_ar'))
                    ->required(),

                RichEditor::make('description.en')
                    ->label(__('keys.description_en'))
                    ->required()
                    ->columnSpanFull(),

                RichEditor::make('description.ar')
                    ->label(__('keys.description_ar'))
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('meta_title.en')
                    ->label(__('keys.meta_title_en'))
                    ->required(),

                TextInput::make('meta_title.ar')
                    ->label(__('keys.meta_title_ar'))
                    ->required(),

                Textarea::make('meta_description.en')
                    ->label(__('keys.meta_description_en'))
                    ->required(),

                Textarea::make('meta_description.ar')
                    ->label(__('keys.meta_description_ar'))
                    ->required(),

                SpatieMediaLibraryFileUpload::make('about_images')
                    ->label(__('keys.image'))
                    ->collection('about_images')
                    ->image()
                    ->imagePreviewHeight('250'),

                SpatieMediaLibraryFileUpload::make('org_structure')
                    ->label(__('keys.org_structure'))
                    ->collection('org_structure')
                    ->image()
                    ->imagePreviewHeight('250'),

                Toggle::make('is_active')
                    ->label(__('keys.active'))
                    ->required()
                    ->default(true),


            ]);
    }


    #--------------------------------------------------------TABLE
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('keys.name'))
                    ->sortable()
                    ->searchable(),

                SpatieMediaLibraryImageColumn::make('about_images')
                    ->label(__('keys.image'))
                    ->collection('about_images')
                    ->circular()
                    ->size(50),

                ToggleColumn::make('is_active')
                    ->label(__('keys.active')),

                TextColumn::make('meta_title')
                    ->label(__('keys.meta_title'))
                    ->limit(50)
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label(__('keys.active'))
                    ->options([
                        '1' => __('keys.active'),
                        '0' => __('keys.inactive'),
                    ]),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
