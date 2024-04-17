<?php

namespace App\Livewire\Helpers\Depense;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\Depense;
use App\Models\RetourCaisse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepenseHelper
{
    /**
     * Get list despense by month
     * @param string $month
     * @return Collection
     */
    public static function getByMonth(string $month, $currency = "", $source = "", $category = "", $type_depense_id): Collection
    {
        $currency == "Aucune" ? $currency = '' : $currency;
        $source == "Aucune" ?  $source = '' : $source;
        $category == "Aucune" ?  $category = '' : $category;
        return Depense::whereMonth('depenses.created_at', $month)
            ->join('currencies', 'currencies.id', 'depenses.currency_id')
            ->join('depense_sources', 'depense_sources.id', 'depenses.depense_source_id')
            ->join('category_depenses', 'category_depenses.id', 'depenses.category_depense_id')
            ->orderBy('depenses.created_at', 'DESC')
            ->select(
                'depenses.*',
                DB::raw('currencies.currency as currency_name'),
                DB::raw('depense_sources.name as source')
            )
            ->with(['currency', 'depenseSource'])
            ->where('depenses.scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->where('depenses.school_id', Auth::user()->school->id)
            ->where('depenses.depense_type_id', $type_depense_id)
            ->where('currencies.currency', 'LIKE', '%' . $currency . '%')
            ->where('depense_sources.name', 'LIKE', '%' . $source . '%')
            ->where('category_depenses.name', 'LIKE', '%' . $category . '%')
            ->get();
    }
    /**
     * Get list despense by date
     * @param string $date
     * @param string $curreny
     * @param string $source
     * @return Collection
     */
    public static function getByDate(string $date, string $curreny = '', $source = "", $category = "", $type_depense_id): Collection
    {
        return Depense::whereDate('depenses.created_at', $date)
            ->join('currencies', 'currencies.id', 'depenses.currency_id')
            ->join('depense_sources', 'depense_sources.id', 'depenses.depense_source_id')
            ->join('category_depenses', 'category_depenses.id', 'depenses.category_depense_id')
            ->orderBy('depenses.created_at', 'DESC')
            ->select(
                'depenses.*',
                DB::raw('currencies.currency as currency_name'),
                DB::raw('depense_sources.name as source'),
                DB::raw('category_depenses.name as category')
            )
            ->with(['currency', 'depenseSource'])
            ->where('depenses.scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->where('depenses.school_id', Auth::user()->school->id)
            ->where('depenses.depense_type_id', $type_depense_id)
            ->where('currencies.currency', 'LIKE', '%' . $curreny . '%')
            ->where('depense_sources.name', 'LIKE', '%' . $source . '%')
            ->where('category_depenses.name', 'LIKE', '%' . $category . '%')
            ->get();
    }

    public static function getAmountGoupingByCurrency(string $month, $type_depense_id): Collection
    {
        return Depense::whereMonth('depenses.created_at', $month)
            ->join('currencies', 'currencies.id', 'depenses.currency_id')
            ->orderBy('depenses.created_at', 'DESC')
            ->where('depenses.scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->where('depenses.school_id', Auth::user()->school->id)
            ->where('depenses.depense_type_id', $type_depense_id)
            ->select(
                'currencies.currency as currency_name',
                DB::raw('sum(depenses.amount) as total'),
            )
            ->groupBy('currencies.currency')
            ->get();
    }

    public static function getAmountByMonthAndByCurrency(string $month, string $curreny = 'USD', $source_id, $type_depense_id): float
    {
        return Depense::whereMonth('depenses.created_at', $month)
            ->join('currencies', 'currencies.id', 'depenses.currency_id')
            ->where('currencies.currency', $curreny)
            ->where('depenses.depense_source_id', $source_id)
            ->where('depenses.scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->where('depenses.school_id', Auth::user()->school->id)
            ->where('depenses.depense_type_id', $type_depense_id)
            ->sum('depenses.amount');
    }


    public static function create(array $inputs)
    {
        $inputs['school_id'] = auth()->user()->school->id;
        $inputs['scolary_year_id'] = (new SchoolHelper())->getCurrectScolaryYear()->id;
        Depense::create($inputs);
    }
    public static function show(string $id): Depense
    {
        return Depense::find($id);
    }
    public static function update(Depense $depense, array $inputs)
    {
        $depense->update($inputs);
    }
    public static function delete(Depense $depense)
    {
        $depense->delete();
    }

    public function getAmountCaisseByDepense(string $month): float
    {

        return RetourCaisse::whereMonth('created_at', $month)
            ->sum('amount');
    }
}
