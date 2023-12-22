<?php

namespace App\Filament\Resources\SchoolResource\Pages;

use App\Filament\Resources\SchoolResource;
use Filament\Actions\CreateAction;

;
use Filament\Resources\Pages\ManageRecords;

class ManageSchools extends ManageRecords
{
    protected static string $resource = SchoolResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
