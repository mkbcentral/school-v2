<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CostGeneralResource\Pages;
use App\Filament\Resources\CostGeneralResource\RelationManagers;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\CostGeneral;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class CostGeneralResource extends Resource
{
    protected static ?string $model = CostGeneral::class;

    protected static ?string $navigationIcon = 'heroicon-o-cash';

    protected static ?string $navigationLabel="Frais scolaire";
    protected static ?string $navigationGroup = 'Gestion de frais';

    public static function getEloquentQuery(): Builder
    {
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        return parent::getEloquentQuery()
            ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('type_other_costs.school_id', auth()->user()->school->id)
            ->where('type_other_costs.scolary_year_id',$scolaryYear->id)
            ->select('cost_generals.*')
            ->orderBy('cost_generals.created_at','DESC');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->required(),
                Forms\Components\Toggle::make('active')
                    ->required(),
                Forms\Components\Select::make('type_other_cost_id')
                    ->relationship('typeOtherCost','name')
                    ->preload(),
                Forms\Components\Select::make('classe_option_id')
                    ->relationship('classeOption','name')
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('classeOption.name')->sortable(),
                Tables\Columns\TextColumn::make('amount')->sortable(),
                Tables\Columns\IconColumn::make('active')->sortable()
                    ->boolean(),

            ])
            ->filters([
                SelectFilter::make('Type Cost')->relationship('typeOtherCost','name'),
                //SelectFilter::make('Scolaryear')->relationship('typeOtherCost','scolaryYear.name'),
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
            'index' => Pages\ManageCostGenerals::route('/'),
        ];
    }
}
