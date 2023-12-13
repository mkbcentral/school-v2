<?php

namespace App\Filament\Resources\CostInscriptionResource\Pages;

use App\Filament\Resources\CostInscriptionResource;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\ScolaryYear;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCostInscriptions extends ManageRecords
{
    protected static string $resource = CostInscriptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
                $data['school_id'] = auth()->user()->school->id;
                $data['scolary_year_id'] = $scolaryYear->id;
                return $data;
            }),
        ];
    }
}
