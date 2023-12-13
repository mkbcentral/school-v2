<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScolaryYearResource\Pages;
use App\Filament\Resources\ScolaryYearResource\RelationManagers;
use App\Models\ScolaryYear;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class ScolaryYearResource extends Resource
{
    protected static ?string $model = ScolaryYear::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'School manager';
    protected static ?string $navigationLabel="Année scolaire";

    protected static ?string $label="Année scolaire";

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('school_id', auth()->user()->school->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('school_id')
                    ->relationship('school', 'name'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school.name')->label('Ecole'),
                Tables\Columns\TextColumn::make('name')->label('Année scolaire'),
                Tables\Columns\ToggleColumn::make('active')->label('Status'),
                Tables\Columns\ToggleColumn::make('is_last_year')->label('Année ppasse'),
                Tables\Columns\ToggleColumn::make('is_old_year')->label('Ancienne année'),
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
            'index' => Pages\ManageScolaryYears::route('/'),
        ];
    }
}
