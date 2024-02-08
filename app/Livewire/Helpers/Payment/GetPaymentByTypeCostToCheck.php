<?php

namespace App\Livewire\Helpers\Payment;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\Payment;

class GetPaymentByTypeCostToCheck
{
    /**
     * Vérifier si un élève à une dette de payment mesuelle sur l'année passée par type frais (TypeOtherCost)
     * @param $idType
     * @param $student_id
     * @param $month
     * @return Payment|null
     */
    public static function getPaymentForLasYearChecker($idType, $student_id, $month): ?Payment
    {
        $scolaryYear = (new SchoolHelper())->getOldScolaryYear(); //Recuperer l'année passée
        return Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->where('payments.student_id', $student_id)
            ->where('payments.school_id', auth()->user()->school->id)
            ->where('payments.scolary_year_id', $scolaryYear->id)
            ->where('cost_generals.type_other_cost_id', $idType)
            ->where('payments.month_name', $month)
            ->first();
    }

    /**
     * Vérifier si l'élève a use dette payement mensuel de l'année en cours par type frais (TypeOtherCost)
     * @param $idType
     * @param $student_id
     * @param $month
     * @return Payment|null
     */
    public static function getCurrentYearPaymentChecker($idType, $student_id, $month, $scolaryYearId): ?Payment
    {
        return Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join('type_other_costs', 'type_other_costs.id', '=', 'cost_generals.type_other_cost_id')
            ->where('payments.student_id', $student_id)
            ->where('payments.school_id', auth()->user()->school->id)
            ->where('payments.scolary_year_id', $scolaryYearId)
            ->where('type_other_costs.id', $idType)
            ->where('payments.month_name', $month)
            ->first();
    }

    /**
     * Vérifier si l'élève a une dette sur l'année scolaire en cours par type frais (TypeOtherCost) et par Frais (CostId)
     * @param $idType
     * @param $student_id
     * @param $month
     * @param $costId
     * @return Payment|null
     */
    public static function getCurrentYearCostPaymentChecker($idType, $student_id, $month, $costId, $scolaryId): ?Payment
    {
        return Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join('type_other_costs', 'type_other_costs.id', '=', 'cost_generals.type_other_cost_id')
            ->where('payments.student_id', $student_id)
            ->where('payments.school_id', auth()->user()->school->id)
            ->where('payments.scolary_year_id', $scolaryId)
            ->where('cost_generals.type_other_cost_id', $idType)
            ->where('payments.month_name', $month)
            ->where('payments.cost_general_id', $costId)
            ->select('payments.month_name')
            ->first();
    }

    /**
     * Vérifier si l'élève a une dette sur l'année scolaire en cours par type frais (TypeOtherCost) et par Frais (CostId)
     * @param $idType
     * @param $student_id
     * @param $month
     * @param $costId
     * @return Payment|null
     */
    public static function getCurrentYearCostPaymentCheckerByTranch($idType, $student_id, $costId, $scolaryId): ?Payment
    {
        return Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join('type_other_costs', 'type_other_costs.id', '=', 'cost_generals.type_other_cost_id')
            ->where('payments.student_id', $student_id)
            ->where('payments.school_id', auth()->user()->school->id)
            ->where('payments.scolary_year_id', $scolaryId)
            ->where('cost_generals.type_other_cost_id', $idType)
            ->where('payments.cost_general_id', $costId)
            ->select('payments.month_name')
            ->first();
    }
}
