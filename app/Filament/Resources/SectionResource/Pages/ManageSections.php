<?php

namespace App\Filament\Resources\SectionResource\Pages;

use App\Filament\Resources\SectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSections extends ManageRecords
{
    protected static string $resource = SectionResource::class;

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
