<?php

namespace App\Http\Controllers\Application\Printings;

use App\Http\Controllers\Controller;
use App\Livewire\Helpers\Depense\DepenseHelper;
use App\Livewire\Helpers\Depense\EmpruntHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PrintingDepenseAndEmpruntController extends Controller
{
    public function printDepenseMonth(string $month){
        $listDepense = DepenseHelper::get($month);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.depense.print-depense-by-month',
            compact(['listDepense','month'])
        );
        return $pdf->stream();
    }

    public function printEmpruntByMonth(string $month){
        $listEmprunt = EmpruntHelper::get($month);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.depense.print-emprunt-by-month',
            compact(['listEmprunt','month'])
        );
        return $pdf->stream();
    }
}
