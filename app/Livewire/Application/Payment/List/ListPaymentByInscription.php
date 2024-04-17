<?php

namespace App\Livewire\Application\Payment\List;

use App\Models\Inscription;
use App\Models\Payment;
use Livewire\Component;

class ListPaymentByInscription extends Component
{
    protected $listeners = [
        'paymentsByInscription' => 'getInscription',
    ];
    public Inscription $inscription;

    public function getInscription(Inscription $inscription)
    {
        $this->inscription = $inscription;
    }
    public function mount()
    {
    }
    public function render()
    {
        return view('livewire.application.payment.list.list-payment-by-inscription', [
            'payments' => Payment::where('payments.inscription_id', 816)
                ->join('cost_generals', 'payments.cost_general_id', '=', 'cost_generals.id')
                ->join('type_other_costs', 'cost_generals.type_other_cost_id', '=', 'type_other_costs.id')
                ->where('cost_generals.type_other_cost_id', 11)
                ->where('payments.month_name', 11)
                ->get()
        ]);
    }
}
