<?php

namespace App\Http\Controllers\Application\Printings;

use App\Http\Controllers\Controller;
use App\Livewire\Helpers\Payment\GetPaymentByMonthHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Classe;
use App\Models\CostGeneral;
use App\Models\Inscription;
use App\Models\Payment;
use App\Models\TypeOtherCost;
use Illuminate\Support\Facades\App;

class PrintingReceiptController extends Controller
{
    public function printReceiptInscription(Inscription $inscription, string $currency = 'USD')
    {
        $inscription->is_paied = true;
        $inscription->update();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.receipts.receipt-inscription-print',
            compact(['inscription', 'currency'])
        );
        return $pdf->stream();
    }
    public function printReceiptPayment(Payment $payment, string $currency = 'USD')
    {
        $payment->is_paid = true;
        $payment->update();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.receipts.receipt-payment-print',
            compact(['payment', 'currency'])
        );
        return $pdf->stream();
    }

    public function printReceiptStudentPayments(Inscription $inscription)
    {

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.receipts.receipt-student-payments-print',
            compact(['inscription'])
        );
        return $pdf->stream();
    }

    public function printListPaymentByMonth(
        $month,
        $type_cost_id,
        $cost_id,
        $classe_id
    ) {
        $typeCost = TypeOtherCost::find($type_cost_id);
        $cost = CostGeneral::find($cost_id);
        $classe = Classe::find($classe_id);
        $payments =
            Payment::join('students', 'students.id', '=', 'payments.student_id')
            ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join('rates', 'rates.id', '=', 'payments.rate_id')
            ->where('payments.scolary_year_id', (new  SchoolHelper())->getCurrentScolaryYear()->id)
            //->where('payments.month_name', $month)
            ->where('cost_generals.type_other_cost_id', $type_cost_id)
            ->where('payments.classe_id', $classe_id)
            ->where('cost_general_id', $cost_id)
            ->where('students.school_id', auth()->user()->school->id)
            ->orderBy('payments.created_at', 'DESC')
            ->where('payments.is_paid', true)
            ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
            ->select('payments.*', 'cost_generals.amount as amount')
            ->get();
        /*
        GetPaymentByMonthHelper::getMonthPayments(
            $month,
            (new SchoolHelper())->getCurrentScolaryYear()->id,
            $cost_id,
            $type_cost_id,
            $classe_id,
            '',
        );
        */
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.payment.print-payment-list',
            compact(['payments', 'typeCost', 'cost', 'month', 'classe'])
        )->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
