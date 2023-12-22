<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppLinkResource\Pages;
use App\Filament\Resources\AppLinkResource\Pages\ManageAppLinks;
use App\Models\AppLink;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppLinkResource extends Resource
{
    protected static ?string $model = AppLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationLabel='Menu principal';
    protected static ?string $navigationGroup = 'Navigations';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->maxLength(255),
                TextInput::make('icon')
                    ->maxLength(255),
                TextInput::make('color')
                    ->maxLength(255),
                TextInput::make('link')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('icon'),
                TextColumn::make('color'),
                TextColumn::make('link'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAppLinks::route('/'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            ManageAppLinks::class,
        ];
    }
}
