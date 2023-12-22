<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CostGeneralResource\Pages;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\CostGeneral;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

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
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('amount')
                    ->required(),
                Toggle::make('active')
                    ->required(),
                Select::make('type_other_cost_id')
                    ->relationship('typeOtherCost','name')
                    ->preload(),
                Select::make('classe_option_id')
                    ->relationship('classeOption','name')
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('name')->sortable()->searchable(),
               TextColumn::make('classeOption.name')->sortable(),
               TextColumn::make('amount')->sortable(),
               IconColumn::make('active')->sortable()
                    ->boolean(),

            ])
            ->filters([
                SelectFilter::make('Type Cost')->relationship('typeOtherCost','name'),
                //SelectFilter::make('Scolaryear')->relationship('typeOtherCost','scolaryYear.name'),
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
            'index' => Pages\ManageCostGenerals::route('/'),
        ];
    }
}
