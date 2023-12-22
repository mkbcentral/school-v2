<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppSettingResource\Pages;
use App\Models\AppSetting;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AppSettingResource extends Resource
{
    protected static ?string $model = AppSetting::class;

        protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup='Paramètres';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('app_name')
                    ->maxLength(255),
                Toggle::make('is_sidebar_collapse')
                    ->required(),
                Toggle::make('is_dark_mode')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('app_name'),
                ToggleColumn::make('is_sidebar_collapse'),
                ToggleColumn::make('is_dark_mode')
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
            'index' => Pages\ManageAppSettings::route('/'),
        ];
    }
}
