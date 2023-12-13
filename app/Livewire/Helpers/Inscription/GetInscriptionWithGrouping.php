<?php

namespace App\Livewire\Helpers\Inscription;

use App\Models\Inscription;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GetInscriptionWithGrouping
{
    public function getAmountInscriptionGroupingByCalsseWithSelectedOption($index,$scolaryYearId,$currency): Collection
    {
        return Inscription::where('inscriptions.scolary_year_id',$scolaryYearId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->join('classes','classes.id','=','inscriptions.classe_id')
            ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
            ->join('rates','rates.id','=','inscriptions.rate_id')
            ->groupBy('classes.name')
            ->where('inscriptions.is_paied',true)
            ->where('classes.classe_option_id',$index)
            ->select(
                'classes.name',
                DB::raw('count(inscriptions.id) as number'),
                DB::raw($currency=='USD'?
                    'sum(cost_inscriptions.amount) as amount':
                    'sum(cost_inscriptions.amount*rates.rate)as amount'))
            ->get();
    }
    public function getCountInscriptionGroupingByClasseOptionByDate($date,$scolaryYearId): Collection
    {
        return Inscription::where('inscriptions.scolary_year_id',$scolaryYearId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->join('classes','classes.id','=','inscriptions.classe_id')
            ->join('classe_options','classe_options.id','=','classes.classe_option_id')
            ->groupBy('classe_options.name')
            ->where('inscriptions.is_paied',true)
            ->whereDate('inscriptions.created_at',$date)
            ->select(
                'classe_options.name',
                DB::raw('count(inscriptions.id) as number'))
            ->with('scolaryyear')
            ->get();
    }
}
