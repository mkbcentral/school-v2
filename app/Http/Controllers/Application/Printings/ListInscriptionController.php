<?php

namespace App\Http\Controllers\Application\Printings;

use App\Http\Controllers\Controller;
use App\Livewire\Helpers\Inscription\GetAllInscriptionHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Classe;
use Illuminate\Support\Facades\App;

class ListInscriptionController extends Controller
{
    public function printListInscriptionByClasse($classeId)
    {
        $inscriptions = GetAllInscriptionHelper::getListInscriptionByClasseForCurrentYear($classeId, '');
        $classe = Classe::find($classeId);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.inscription.print-list-inscription-by-classse',
            compact(['inscriptions', 'classe'])
        );
        return $pdf->stream();
    }

    public function printNumberInscription(bool $isOld)
    {
        $classeOptions = (new SchoolHelper())->getListClasseOption();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.inscription.print-number-inscription',
            compact(['classeOptions', 'isOld'])
        );
        return $pdf->stream();
    }
}
