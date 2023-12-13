<?php

namespace App\Livewire\Helpers\Payment;

use App\Models\Paiment;
use App\Models\Payment;

class CreatePaymentCheckerHelper
{
    /**
     * Vérifier si un élève a déjà un payment au cours du mois avant de faire passer une autre payment
     * @param $student_id
     * @param $month
     * @param $type_other_cost
     * @param $defaultScolaryYerId
     * @return bool
     */
    public static function checkIfPaymentExistBeforCreate($student_id, $month, $type_other_cost,$defaultScolaryYerId): bool
    {
        $status = false;
        $payment = Payment::where('payments.student_id', $student_id)
            ->where('month_name',$month)
            ->where('payments.cost_general_id', $type_other_cost)
            ->where('payments.school_id', auth()->user()->school->id)
            ->where('payments.scolary_year_id', $defaultScolaryYerId)
            ->first();
        if ($payment) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
}
