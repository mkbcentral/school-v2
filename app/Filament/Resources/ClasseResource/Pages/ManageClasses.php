<?php

namespace App\Filament\Resources\ClasseResource\Pages;

use App\Filament\Resources\ClasseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageClasses extends ManageRecords
{
    protected static string $resource = ClasseResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
