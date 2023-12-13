<?php

namespace App\Http\Controllers\Application\Printings;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use App\Models\Payment;
use App\Models\Rate;

class PrintingReceiptController extends Controller
{
    public function printReceiptInscription(Inscription $inscription,string $currency='USD'){
        $inscription->is_paied=true;
        $inscription->update();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.receipts.receipt-inscription-print',
            compact(['inscription', 'currency'])
        );
        return $pdf->stream();

    }
    public function printReceiptPayment(Payment $payment,string $currency='USD'){
        $payment->is_paid=true;
        $payment->update();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.receipts.receipt-payment-print',
            compact(['payment', 'currency'])
        );
        return $pdf->stream();
    }
}
