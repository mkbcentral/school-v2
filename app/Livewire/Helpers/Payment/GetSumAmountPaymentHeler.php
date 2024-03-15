<?php

namespace App\Livewire\Helpers\Payment;

use App\Models\Payment;

use Illuminate\Support\Facades\DB;

class GetSumAmountPaymentHeler
{
    public static  function getSumAmountPaymentByDate($date, $scolaryYearId)
    {
        return Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join('currencies', 'currencies.id', '=', 'cost_generals.currency_id')
            ->where('payments.scolary_year_id', $scolaryYearId)
            ->whereDate('payments.created_at', $date)
            ->where('payments.school_id', auth()->user()->school->id)
            ->where('payments.is_paid', true)
            ->select(
                'currencies.currency',
                DB::raw('sum(cost_generals.amount) as total'),
            )
            ->groupBy('currencies.currency')
            ->get();
    }
}
