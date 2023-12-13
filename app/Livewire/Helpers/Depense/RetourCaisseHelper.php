<?php

namespace App\Livewire\Helpers\Depense;

use App\Models\RetourCaisse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RetourCaisseHelper
{
    public static function get(string $month): Collection
    {
        return RetourCaisse::whereMonth('created_at', $month)->orderBy('created_at', 'DESC')->get();
    }
    public static function create(array $inputs): RetourCaisse
    {
        $inputs['school_id']=auth()->user()->school->id;
        $inputs['code'] = 'AQ-RC' . date('d') . '-' . date('m') . '-' . date('y') . '-' . rand(1000, 10000);
        return RetourCaisse::create($inputs);
    }
    public static function show(string $id): RetourCaisse
    {
        return RetourCaisse::find($id);
    }
    public static function update(RetourCaisse $retourCaisse, array $inputs): retourCaisse
    {
        $retourCaisse->update($inputs);
        return $retourCaisse;
    }
    public static function delete(RetourCaisse $retourCaisse)
    {
        $retourCaisse->delete();
    }

    public static function getAmountRetourCaisseGroupingByCurrency(string $month): Collection
    {
        return RetourCaisse::join('currencies', 'currencies.id', 'RetourCaisses.currency_id')
            ->whereMonth('RetourCaisses.created_at', $month)
            ->select('currencies.currency', DB::raw('sum(RetourCaisses.amount) as total'))
            ->groupBy('currencies.currency')
            ->with('currecny')
            ->get();
    }
}
