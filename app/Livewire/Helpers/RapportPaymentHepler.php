<?php
namespace  App\Livewire\Helpers;

use App\Models\Inscription;
use App\Models\Paiment;
use App\Models\Payment;

class RapportPaymentHepler{
    public function getPaiementsByType(){
        return Payment::join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
                ->groupBy('type_other_costs.name')
                ->selectRaw('sum(cost_generals.amount*2000) as total, type_other_costs.name')
                ->where('payments.scolary_year_id','1')
                ->get();
    }

}
