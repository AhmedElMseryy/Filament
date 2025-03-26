<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\HeroSection;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HeroSectionResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\HeroSectionResource\RelationManagers;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    public static function getPluralModelLabel(): string
    {
        return __('keys.hero_sections');
    }

    public static function getModelLabel(): string
    {
        return __('keys.hero_section');
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
                TextInput::make('name.en')
                    ->label(__('keys.name_en'))
                    ->required(),

                TextInput::make('name.ar')
                    ->label(__('keys.name_ar'))
                    ->required(),

                RichEditor::make('sub_description.en')
                    ->label(__('keys.sub_description_en'))
                    ->required(),

                RichEditor::make('sub_description.ar')
                    ->label(__('keys.sub_description_ar'))
                    ->required(),

                RichEditor::make('description.en')
                    ->label(__('keys.description_en'))
                    ->required(),

                RichEditor::make('description.ar')
                    ->label(__('keys.description_ar'))
                    ->required(),

                SpatieMediaLibraryFileUpload::make('heroSection_images')
                    ->label(__('keys.image'))
                    ->collection('heroSection_images')
                    ->image()
                    ->imagePreviewHeight('250'),
            ]);
    }


    #--------------------------------------------------------TABLE
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
}
