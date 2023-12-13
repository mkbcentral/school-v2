<?php

namespace App\Filament\Resources\GenderResource\Pages;

use App\Filament\Resources\GenderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGenders extends ManageRecords
{
    protected static string $resource = GenderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
