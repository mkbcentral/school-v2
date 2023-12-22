<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClasseResource\Pages;
use App\Models\Classe;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ClasseResource extends Resource
{
    protected static ?string $model = Classe::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'School manager';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->join('classe_options', 'classe_options.id', '=', 'classes.classe_option_id')
            ->join('sections', 'sections.id', '=', 'classe_options.section_id')
            ->join('schools', 'schools.id', '=', 'sections.school_id')
            ->where('sections.school_id', auth()->user()->school->id)
            ->select('classes.*');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('classe_option_id')
                    ->relationship('classeOption', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
            ])
            ->filters([
                SelectFilter::make('Année scolaire')->relationship('classeOption','name'),
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
            'index' => Pages\ManageClasses::route('/'),
        ];
    }
}
