<?php

namespace App\Filament\Resources\CurrencyResource\Pages;

use App\Filament\Resources\CurrencyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCurrencies extends ManageRecords
{
    protected static string $resource = CurrencyResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                $data['school_id'] = auth()->user()->school->id;
                return $data;
            }),
        ];
    }
}
