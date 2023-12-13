<?php

namespace App\Livewire\Helpers\Payment;

use App\Livewire\Helpers\Invoice\FormatInvoiceNumberHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\LatePayment;
use App\Models\Paiment;
use App\Models\Payment;

class  CreateNewPaymentHelper
{
    /**
     * Créer un nouveau  payment
     * @param $month
     * @param $cost_other_id
     * @param $classeOptionId
     * @param $inscriptionId
     * @param $studentId
     * @param $scolaryId
     * @param $classeId
     * @return Payment
     */
    public static function create($month,$cost_other_id,$classeOptionId,$inscriptionId,$studentId,$scolaryId,$classeId):Payment{
        $rate=(new SchoolHelper())->getCurrentRate();
        return Payment::create([
             'number_payment'=>(new FormatInvoiceNumberHelper())->formatPaymentInvoiceNumber($classeOptionId),
             'month_name'=>$month,
             'cost_general_id'=>$cost_other_id,
             'classe_id'=>$classeId,
             'scolary_year_id'=>$scolaryId,
             'inscription_id'=>$inscriptionId,
             'student_id'=>$studentId,
             'school_id'=>auth()->user()->school->id,
             'user_id'=>auth()->user()->id,
             'rate_id'=>$rate->id,
         ]);
    }

    public static function createLatePayment(array $inputs){
        $rate=(new SchoolHelper())->getCurrentRate();
        $oldScolaryYear=(new SchoolHelper())->getOldScolaryYear();
        LatePayment::create([
            'number_payment'=>(new FormatInvoiceNumberHelper())->formatLatePaymentInvoiceNumber($inputs['option_id']),
            'month_name'=>$inputs['month'],
            'currency'=>$inputs['currency'],
            'amount'=>$inputs['amount'],
            'inscription_id'=>$inputs['inscription_id'],
            'cost_general_id'=>$inputs['cost_general_id'],
            'rate_id'=>$rate->id,
            'scolary_year_id'=>$oldScolaryYear->id,
            'school_id'=>auth()->user()->school->id,
            'created_at'=>$inputs['created_at'],
            'user_id'=>auth()->user()->id,
        ]);
    }
}
