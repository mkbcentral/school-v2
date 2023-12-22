<?php

namespace App\Filament\Resources\ClasseOptionResource\Pages;

use App\Filament\Resources\ClasseOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageClasseOptions extends ManageRecords
{
    protected static string $resource = ClasseOptionResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
