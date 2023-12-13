<?php

namespace  App\Livewire\Helpers\Payment;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GetPaymentByDateHelper
{
    /**
     * Recuprer les payment par jour
     * @param $date
     * @param $idSColaryYear
     * @param $idCost
     * @param $type
     * @param $classeId
     * @param $keySearch
     * @param $currency
     * @return mixed
     */
    public static function getDatePayments($date, $idSColaryYear, $idCost, $type, $classeId, $keySearch)
    {
        if ($type == 0) {
            if ($classeId == 0) {
                if ($idCost == 0) {
                    $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                        ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                        ->join('rates', 'rates.id', '=', 'payments.rate_id')
                        ->where('payments.scolary_year_id', $idSColaryYear)
                        ->whereDate('payments.created_at', $date)
                        ->where('students.name', 'Like', '%' . $keySearch . '%')
                        ->orderBy('payments.created_at', 'DESC')
                        ->where('payments.school_id', auth()->user()->school->id)
                        ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                        ->select('payments.*', 'cost_generals.amount as amount')
                        ->get();
                } else {
                    $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                        ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                        ->join('rates', 'rates.id', '=', 'payments.rate_id')
                        ->where('payments.scolary_year_id', $idSColaryYear)
                        ->whereDate('payments.created_at', $date)
                        ->where('students.name', 'Like', '%' . $keySearch . '%')
                        ->where('payments.cost_general_id', $idCost)
                        ->orderBy('payments.created_at', 'DESC')
                        ->where('payments.school_id', auth()->user()->school->id)
                        ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                        ->select('payments.*', 'cost_generals.amount as amount')
                        ->get();
                        
                }
            } else {
                if ($idCost == 0) {
                    $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                        ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                        ->join('rates', 'rates.id', '=', 'payments.rate_id')
                        ->where('payments.scolary_year_id', $idSColaryYear)
                        ->whereDate('payments.created_at', $date)
                        ->where('students.name', 'Like', '%' . $keySearch . '%')
                        ->where('payments.classe_id', $classeId)
                        ->orderBy('payments.created_at', 'DESC')
                        ->where('payments.school_id', auth()->user()->school->id)
                        ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                        ->select('payments.*', 'cost_generals.amount as amount')
                        ->get();
                } else {
                    $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                        ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                        ->join('rates', 'rates.id', '=', 'payments.rate_id')
                        ->where('payments.scolary_year_id', $idSColaryYear)
                        ->whereDate('payments.created_at', $date)
                        ->where('students.name', 'Like', '%' . $keySearch . '%')
                        ->where('cost_general_id', $idCost)
                        ->where('payments.classe_id', $classeId)
                        ->orderBy('payments.created_at', 'DESC')
                        ->where('payments.school_id', auth()->user()->school->id)
                        ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                        ->select('payments.*', 'cost_generals.amount as amount')
                        ->get();
                }
            }
        } else {
            if ($classeId == 0) {
                if ($idCost == 0) {
                    $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                        ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                        ->join('rates', 'rates.id', '=', 'payments.rate_id')
                        ->where('payments.scolary_year_id', $idSColaryYear)
                        ->whereDate('payments.created_at', $date)
                        ->where('students.name', 'Like', '%' . $keySearch . '%')
                        ->orderBy('payments.created_at', 'DESC')
                        ->where('payments.school_id', auth()->user()->school->id)
                        ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                        ->select('payments.*', 'cost_generals.amount as amount')
                        ->get();
                } else {
                    $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                        ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                        ->join('rates', 'rates.id', '=', 'payments.rate_id')
                        ->where('payments.scolary_year_id', $idSColaryYear)
                        ->whereDate('payments.created_at', $date)
                        ->where('students.name', 'Like', '%' . $keySearch . '%')
                        ->where('cost_generals.type_other_cost_id', $type)
                        ->where('payments.cost_general_id', $idCost)
                        ->orderBy('payments.created_at', 'DESC')
                        ->where('payments.school_id', auth()->user()->school->id)
                        ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                        ->select('payments.*', 'cost_generals.amount as amount')
                        ->get();
                }
            } else {
                if ($idCost == 0) {
                    $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                        ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                        ->join('rates', 'rates.id', '=', 'payments.rate_id')
                        ->where('payments.scolary_year_id', $idSColaryYear)
                        ->whereDate('payments.created_at', $date)
                        ->where('students.name', 'Like', '%' . $keySearch . '%')
                        ->where('cost_generals.type_other_cost_id', $type)
                        ->where('payments.classe_id', $classeId)
                        ->orderBy('payments.created_at', 'DESC')
                        ->where('payments.school_id', auth()->user()->school->id)
                        ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                        ->select('payments.*', 'cost_generals.amount as amount')
                        ->get();
                } else {
                    $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                        ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                        ->join('rates', 'rates.id', '=', 'payments.rate_id')
                        ->where('payments.scolary_year_id', $idSColaryYear)
                        ->whereDate('payments.created_at', $date)
                        ->where('students.name', 'Like', '%' . $keySearch . '%')
                        ->where('cost_generals.type_other_cost_id', $type)
                        ->where('cost_general_id', $idCost)
                        ->where('payments.classe_id', $classeId)
                        ->orderBy('payments.created_at', 'DESC')
                        ->where('payments.school_id', auth()->user()->school->id)
                        ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                        ->select('payments.*', 'cost_generals.amount as amount')
                        ->get();
                }
            }
        }
        return $payments;
    }
}
