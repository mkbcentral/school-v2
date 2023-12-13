<?php

namespace App\Livewire\Application\Dashboard;

use App\Livewire\Helpers\Payment\GetAmountPaymentGroupingByTypeCost;
use App\Livewire\Helpers\Printing\PosPrintingHelper;
use App\Models\AppLink;
use App\Models\Payment;
use Livewire\Component;

class MainDashboard extends Component
{
    public string $day='';

    public function updatedDay($val){
       $this->dispatch('changeDateInscription',$val);
    }
    public function mount(){
        $this->day=date('Y-m-d');
    }
    public function render( )
    {
        return view('livewire.application.dashboard.main-dashboard');
    }
}
