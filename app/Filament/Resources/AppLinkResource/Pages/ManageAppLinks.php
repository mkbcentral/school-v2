<?php

namespace App\Filament\Resources\AppLinkResource\Pages;

use App\Filament\Resources\AppLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAppLinks extends ManageRecords
{
    protected static string $resource = AppLinkResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
