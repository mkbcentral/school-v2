<?php

namespace App\Livewire\Helpers\Inscription;

use App\Models\Inscription;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GetInscriptionByDateHelper
{
    /**
     * Récuprer la liste des inscription par date
     * @param $date
     * @param $scolaryYearId
     * @param $classeId
     * @param $costId
     * @param $currency
     * @return Collection
     */
    public function getDateInscriptions($date,$scolaryYearId,$classeId,$costId,$currency){
        if ($classeId==0) {
            if ($costId==0) {
                $inscriptions=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->orderBy('inscriptions.created_at','DESC','classe')
                    ->with(['Cost','student','school','classe.classeOption'])
                    ->select('inscriptions.*',$currency=='USD'? 'cost_inscriptions.amount as amount': DB::raw('cost_inscriptions.amount*rates.rate as amount'))
                    ->paginate(10);
            } else {
                $inscriptions=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->where('inscriptions.cost_inscription_id',$costId)
                    ->with(['Cost','student','school','classe.classeOption'])
                    ->select('inscriptions.*',$currency=='USD'? 'cost_inscriptions.amount as amount': DB::raw('cost_inscriptions.amount*rates.rate as amount'))
                    ->paginate(10);
            }

        } else {
            if ($costId==0) {
                $inscriptions=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->where('inscriptions.classe_id',$classeId)
                    ->with(['Cost','student','school','classe.classeOption'])
                    ->select('inscriptions.*',$currency=='USD'? 'cost_inscriptions.amount as amount': DB::raw('cost_inscriptions.amount*rates.rate as amount'))
                    ->paginate(10);
            } else {
                $inscriptions=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->where('inscriptions.classe_id',$classeId)
                    ->where('inscriptions.cost_inscription_id',$costId)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->with(['Cost','student','school','classe.classeOption'])
                    ->select('inscriptions.*',$currency=='USD'? 'cost_inscriptions.amount as amount': DB::raw('cost_inscriptions.amount*rates.rate as amount'))
                    ->paginate(10);
            }

        }
        return $inscriptions;
    }
}
