<?php

namespace App\Livewire\Helpers\Payment;

use App\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GetPaymentByMonthHelper
{
    /**
     * Récuperer les payments par mois
     * @param $month
     * @param $idSColaryYear
     * @param $idCost
     * @param $type
     * @param $classeId
     * @param $keySearch
     * @param $currency
     * @return mixed
     */
    public static function getMonthPayments($month, $idSColaryYear, $idCost, $type, $classeId, $keySearch)
    {
        if ($classeId == 0) {
            if ($idCost == 0) {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->where('payments.month_name', $month)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('payments.*', 'cost_generals.amount as amount')
                    ->paginate(25);
            } else {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->where('payments.month_name', $month)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('cost_general_id', $idCost)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('payments.*', 'cost_generals.amount as amount')
                    ->paginate(25);
            }
        } else {
            if ($idCost == 0) {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->where('payments.month_name', $month)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('payments.classe_id', $classeId)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('payments.*', 'cost_generals.amount as amount')
                    ->paginate(25);
            } else {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->where('payments.month_name', $month)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('payments.classe_id', $classeId)
                    ->where('cost_general_id', $idCost)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('payments.*', 'cost_generals.amount as amount')
                    ->paginate(25);
            }
        }
        return $payments;
    }
    public static function getDatePaiments($date, $idSColaryYear, $idCost, $type, $classeId, $keySearch)
    {
        if ($classeId == 0) {
            if ($idCost == 0) {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->whereDate('payments.created_at', $date)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('payments.*', 'cost_generals.amount as amount')
                    ->paginate(15);
            } else {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->whereDate('payments.created_at', $date)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('cost_general_id', $idCost)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('payments.*', 'cost_generals.amount as amount')
                    ->paginate(15);
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
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('payments.*', 'cost_generals.amount as amount')
                    ->paginate(15);
            } else {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->whereDate('payments.created_at', $date)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('payments.classe_id', $classeId)
                    ->where('cost_general_id', $idCost)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('payments.*', 'cost_generals.amount as amount')
                    ->paginate(15);
            }
        }
        return $payments;
    }
    public static function getAmoutMonthPayments($month, $idSColaryYear, $idCost, $type, $classeId, $keySearch)
    {
        if ($classeId == 0) {
            if ($idCost == 0) {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('currencies', 'currencies.id', '=', 'cost_generals.currency_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->where('payments.month_name', $month)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('currencies.currency', DB::raw('SUM(cost_generals.amount) as amount'))
                    ->groupBy('currencies.currency')
                    ->get();
            } else {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('currencies', 'currencies.id', '=', 'cost_generals.currency_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->where('payments.month_name', $month)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('cost_general_id', $idCost)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('currencies.currency', DB::raw('SUM(cost_generals.amount) as amount'))
                    ->groupBy('currencies.currency')
                    ->get();
            }
        } else {
            if ($idCost == 0) {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('currencies', 'currencies.id', '=', 'cost_generals.currency_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->where('payments.month_name', $month)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('payments.classe_id', $classeId)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('currencies.currency', DB::raw('SUM(cost_generals.amount) as amount'))
                    ->groupBy('currencies.currency')
                    ->get();
            } else {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('currencies', 'currencies.id', '=', 'cost_generals.currency_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->where('payments.month_name', $month)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('payments.classe_id', $classeId)
                    ->where('cost_general_id', $idCost)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('currencies.currency', DB::raw('SUM(cost_generals.amount) as amount'))
                    ->groupBy('currencies.currency')
                    ->get();
            }
        }
        return $payments;
    }
    public static function getAmoutDatePayments($date, $idSColaryYear, $idCost, $type, $classeId, $keySearch)
    {
        if ($classeId == 0) {
            if ($idCost == 0) {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('currencies', 'currencies.id', '=', 'cost_generals.currency_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->whereDate('payments.created_at', $date)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('currencies.currency', DB::raw('SUM(cost_generals.amount) as amount'))
                    ->groupBy('currencies.currency')
                    ->get();
            } else {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('currencies', 'currencies.id', '=', 'cost_generals.currency_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->whereDate('payments.created_at', $date)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('cost_general_id', $idCost)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('currencies.currency', DB::raw('SUM(cost_generals.amount) as amount'))
                    ->groupBy('currencies.currency')
                    ->get();
            }
        } else {
            if ($idCost == 0) {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('currencies', 'currencies.id', '=', 'cost_generals.currency_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->whereDate('payments.created_at', $date)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('payments.classe_id', $classeId)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('currencies.currency', DB::raw('SUM(cost_generals.amount) as amount'))
                    ->groupBy('currencies.currency')
                    ->get();
            } else {
                $payments = Payment::join('students', 'students.id', '=', 'payments.student_id')
                    ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                    ->join('currencies', 'currencies.id', '=', 'cost_generals.currency_id')
                    ->join('rates', 'rates.id', '=', 'payments.rate_id')
                    ->where('payments.scolary_year_id', $idSColaryYear)
                    ->whereDate('payments.created_at', $date)
                    ->where('students.name', 'Like', '%' . $keySearch . '%')
                    ->where('cost_generals.type_other_cost_id', $type)
                    ->where('payments.classe_id', $classeId)
                    ->where('cost_general_id', $idCost)
                    ->where('students.school_id', auth()->user()->school->id)
                    ->orderBy('payments.created_at', 'DESC')
                    ->where('payments.is_paid', true)
                    ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                    ->select('currencies.currency', DB::raw('SUM(cost_generals.amount) as amount'))
                    ->groupBy('currencies.currency')
                    ->get();
            }
        }
        return $payments;
    }

    public static function getLatePayments($month, $next_month, $idSColaryYear, $type): Collection
    {
        return  Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join('rates', 'rates.id', '=', 'payments.rate_id')
            ->where('payments.scolary_year_id', $idSColaryYear)
            ->whereMonth('payments.created_at', $month)
            ->where('payments.month_name', '!=', $month)
            ->where('payments.month_name', '!=', $next_month)
            ->where('cost_generals.type_other_cost_id', $type)
            ->where('payments.school_id', auth()->user()->school->id)
            ->orderBy('payments.created_at', 'DESC')
            ->where('payments.is_paid', true)
            ->with(['cost.currency', 'inscription.classe.classeOption', 'inscription'])
            ->select('payments.*', 'cost_generals.amount as amount')
            ->get();
    }
}
