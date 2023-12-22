<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScolaryYearResource\Pages;
use App\Models\ScolaryYear;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


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
                Select::make('school_id')
                    ->relationship('school', 'name'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school.name')->label('Ecole'),
                TextColumn::make('name')->label('Année scolaire'),
                ToggleColumn::make('active')->label('Status'),
                ToggleColumn::make('is_last_year')->label('Année ppasse'),
                ToggleColumn::make('is_old_year')->label('Ancienne année'),
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
            'index' => Pages\ManageScolaryYears::route('/'),
        ];
    }
}
