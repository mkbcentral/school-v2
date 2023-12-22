<?php

namespace App\Filament\Resources\RateResource\Pages;

use App\Filament\Resources\RateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageRates extends ManageRecords
{
    protected static string $resource = RateResource::class;

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
