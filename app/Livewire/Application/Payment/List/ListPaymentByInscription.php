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
    
    public function getInscription(Inscription $inscription){
        $this->inscription=$inscription;
    }
    public function mount(Inscription $inscription){
        $this->inscription = $inscription;
    }
    public function render()
    {
        return view('livewire.application.payment.list.list-payment-by-inscription');
    }
}
