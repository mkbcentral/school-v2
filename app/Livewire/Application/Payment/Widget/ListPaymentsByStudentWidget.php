<?php

namespace App\Livewire\Application\Payment\Widget;

use App\Models\Inscription;
use Livewire\Component;

class ListPaymentsByStudentWidget extends Component
{
    protected $listeners=[
        'InscriptionData'=>'getInscription'
    ];
    public ?Inscription $inscription=null;

    public function getInscription(Inscription $inscription){
        $this->inscription=$inscription;
    }
    public function render()
    {
        return view('livewire.application.payment.widget.list-payments-by-student-widget');
    }
}
