<?php

namespace App\Filament\Resources\GenderResource\Pages;

use App\Filament\Resources\GenderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageGenders extends ManageRecords
{
    protected static string $resource = GenderResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
