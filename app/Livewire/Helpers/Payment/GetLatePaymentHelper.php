<?php
namespace App\Livewire\Helpers\Payment;

use App\Models\LatePayment;
use Illuminate\Support\Collection;
/**
 * Get payments by date
 */
class GetLatePaymentHelper{
    public static function getPaymentByDate(string $date):Collection{
        return LatePayment::whereDate('created_at',$date)
                ->with(['costGeneral','inscription'])
                ->get();
    }
    public static function getPaymentByMonth(string $month):Collection{
        return LatePayment::whereMonth('created_at',$month)
                ->with(['costGeneral','inscription'])
                ->get();
    }

    public static function getPaymentByYear(string $year):Collection{
        return LatePayment::whereYear('created_at',$year)
                ->with(['costGeneral','inscription'])
                ->get();
    }
    public static function getSumPaymentByDay(string $date):float{
        return LatePayment::whereDate('created_at',$date)
                ->with(['costGeneral','inscription'])
                ->sum('amount');
    }
    public static function getSumPaymentByMonth(string $month):float{
        return LatePayment::whereMonth('created_at',$month)
                ->with(['costGeneral','inscription'])
                ->sum('amount');
    }
}
