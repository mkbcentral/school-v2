<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubAppLinkResource\Pages;
use App\Models\SubAppLink;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubAppLinkResource extends Resource
{
    protected static ?string $model = SubAppLink::class;
    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';
    protected static ?string $navigationLabel='Sous menu';
    protected static ?string $navigationGroup = 'Navigations';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->maxLength(255),
                TextInput::make('icon')
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
                TextColumn::make('link'),
            ])
            ->filters([
                //
            ])
            ->actions([
               EditAction::make(),
               DeleteAction::make(),
            ])
            ->bulkActions([
               DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSubAppLinks::route('/'),
        ];
    }
}
