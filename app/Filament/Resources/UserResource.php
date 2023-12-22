<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Administration';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('school_id', auth()->user()->school->id)
            ->orderBy('created_at','desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               TextInput::make('name')
                    ->required()
                    ->maxLength(255),
               FileUpload::make('avatar'),
               TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
               Select::make('roles')
                    ->multiple()
                    ->relationship('roles','name')
                    ->preload(),
               Select::make('permissions')
                    ->multiple()
                    ->relationship('permissions','name')
                    ->preload()
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                ImageColumn::make('avatar')->circular(),
                TextColumn::make('email'),
                TextColumn::make('school.name'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
