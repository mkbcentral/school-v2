<?php

namespace App\Filament\Resources\AppSettingResource\Pages;

use App\Filament\Resources\AppSettingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAppSettings extends ManageRecords
{
    protected static string $resource = AppSettingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
