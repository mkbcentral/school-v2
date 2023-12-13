<?php

namespace App\Livewire\Helpers\Depense;

use App\Models\Emprunt;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EmpruntHelper
{
    public static function get(string $month): Collection
    {
        return Emprunt::join('currencies', 'currencies.id', 'emprunts.currency_id')
            ->whereMonth('emprunts.created_at', $month)
            ->orderBy('emprunts.created_at', 'DESC')
            ->select('emprunts.*','currencies.currency as currency_name')
            ->get();
    }
    public static function create(array $inputs): Emprunt
    {
        $inputs['school_id'] = auth()->user()->school->id;
        $inputs['code'] = 'AQ-' . date('d') . '-' . date('m') . '-' . date('y') . '-' . rand(1000, 10000);
        return Emprunt::create($inputs);
    }
    public static function show(string $id): Emprunt
    {
        return Emprunt::find($id);
    }
    public static function update(Emprunt $emprunt, array $inputs): Emprunt
    {
        $emprunt->update($inputs);
        return $emprunt;
    }
    public static function delete(Emprunt $emprunt)
    {
        $emprunt->delete();
    }

    public static function getAmountEmpruntGroupingByCurrency(string $month): Collection
    {
        return Emprunt::join('currencies', 'currencies.id', 'emprunts.currency_id')
            ->whereMonth('emprunts.created_at', $month)
            ->select('currencies.currency', DB::raw('sum(emprunts.amount) as total'))
            ->groupBy('currencies.currency')
            ->with('currecny')
            ->get();
    }
}
