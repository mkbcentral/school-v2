<?php

namespace App\Http\Controllers\Application\Printings;

use App\Http\Controllers\Controller;
use App\Livewire\Helpers\Depense\DepenseHelper;
use App\Livewire\Helpers\Depense\EmpruntHelper;
use Illuminate\Support\Facades\App;

class PrintingDepenseAndEmpruntController extends Controller
{
    public function printDepenseMonth($month, $currency, $source, $category, $type_depense_id)
    {
        $currency == "Aucune" ? $currency = '' : $currency;
        $source == "Aucune" ?  $source = '' : $source;
        $category == "Aucune" ?  $category = '' : $category;
        $listDepense = DepenseHelper::getByMonth(
            $month,
            $currency,
            $source,
            $category,
            $type_depense_id
        );
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.depense.print-depense-by-month',
            compact([
                'listDepense',
                'month',
                'currency',
                'source',
                'category'
            ])
        )->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function printEmpruntByMonth(string $month)
    {
        $listEmprunt = EmpruntHelper::get($month);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.depense.print-emprunt-by-month',
            compact(['listEmprunt', 'month'])
        );
        return $pdf->stream();
    }
}
