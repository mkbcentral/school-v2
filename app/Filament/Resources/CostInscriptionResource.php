<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CostInscriptionResource\Pages;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\CostInscription;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CostInscriptionResource extends Resource
{
    protected static ?string $model = CostInscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel="Type frais inscription";
    protected static ?string $navigationGroup = 'Gestion de frais';

    public static function getEloquentQuery(): Builder
    {
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        return parent::getEloquentQuery()
            ->where('school_id', auth()->user()->school->id)
            ->where('scolary_year_id',$scolaryYear->id)
            ->orderBy('created_at','DESC');
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('amount')->sortable(),
                ToggleColumn::make('active'),
            ])
            ->filters([
                SelectFilter::make('Sections')->relationship('scolaryYear','name'),
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
            'index' => Pages\ManageCostInscriptions::route('/'),
        ];
    }
}
