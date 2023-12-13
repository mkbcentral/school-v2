<?php

namespace App\Livewire\Application\Payment;

use App\Livewire\Helpers\Inscription\GetInscriptionByDateWithPaymentStatusHelper;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Mediumart\Orange\SMS\Http\SMSClient;
use Mediumart\Orange\SMS\SMS;

class ValideInscriptionPayment extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
    ];
    public  $inscriptionList = [];
    public $defaultScolaryYerId;

    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }
    public function loadData():Collection
    {
      return  $this->inscriptionList = (new GetInscriptionByDateWithPaymentStatusHelper())
            ->getDateInscriptions($this->date_to_search, $this->defaultScolaryYerId, $this->classe_id, 0,'USD');
    }
    public function render()
    {
        return view('livewire.application.payment.valide-inscription-payment');
    }
}
