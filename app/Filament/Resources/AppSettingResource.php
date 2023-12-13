<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppSettingResource\Pages;
use App\Filament\Resources\AppSettingResource\RelationManagers;
use App\Models\AppSetting;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppSettingResource extends Resource
{
    protected static ?string $model = AppSetting::class;

        protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup='Paramètres';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('app_name')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_sidebar_collapse')
                    ->required(),
                Forms\Components\Toggle::make('is_dark_mode')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('app_name'),
                Tables\Columns\ToggleColumn::make('is_sidebar_collapse'),
                Tables\Columns\ToggleColumn::make('is_dark_mode')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAppSettings::route('/'),
        ];
    }
}
