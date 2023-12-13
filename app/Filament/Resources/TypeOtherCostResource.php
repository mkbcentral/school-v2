<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeOtherCostResource\Pages;
use App\Filament\Resources\TypeOtherCostResource\RelationManagers;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\TypeOtherCost;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeOtherCostResource extends Resource
{
    protected static ?string $model = TypeOtherCost::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel="Type frais scolaire";
    protected static ?string $navigationGroup = 'Gestion de frais';

    public static function getEloquentQuery(): Builder
    {
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        return parent::getEloquentQuery()
            ->where('school_id', auth()->user()->school->id)
            ->where('scolary_year_id',$scolaryYear->id);
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('scolary_year_id')
                    ->relationship('scolaryYear','name')
                    ->preload(),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\ToggleColumn::make('active'),
                Tables\Columns\ToggleColumn::make('is_by_tranch')->label('Par tranche'),
            ])
            ->filters([
                SelectFilter::make('Sections')->relationship('scolaryYear','name'),
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
            'index' => Pages\ManageTypeOtherCosts::route('/'),
        ];
    }
}
