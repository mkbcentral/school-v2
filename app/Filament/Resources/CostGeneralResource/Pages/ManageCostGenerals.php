<?php

namespace App\Filament\Resources\CostGeneralResource\Pages;

use App\Filament\Resources\CostGeneralResource;
use Filament\Actions\CreateAction;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCostGenerals extends ManageRecords
{
    protected static string $resource = CostGeneralResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
