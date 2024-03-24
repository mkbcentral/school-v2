<?php

namespace App\Livewire\Application\Payment;

use Livewire\Component;

class FinanceByCostRepportView extends Component
{
    public $months = [];

    public function mount()
    {
        $this->months = [
            ['name' => 'Juillet', 'value' => '07'],
            ['name' => 'Aout', 'value' => '08'],
            ['name' => 'Septembre', 'value' => '09'],
            ['name' => 'Octobre', 'value' => '10'],
            ['name' => 'Novembre', 'value' => '11'],
            ['name' => 'Décembre', 'value' => '12'],
            ['name' => 'Janvier', 'value' => '01'],
            ['name' => 'Février', 'value' => '02'],
            ['name' => 'Mars', 'value' => '03'],
            ['name' => 'Avril', 'value' => '04'],
            ['name' => 'Mai', 'value' => '05'],
            ['name' => 'Juin', 'value' => '06'],
        ];
    }
    public function render()
    {
        return view('livewire.application.payment.finance-by-cost-repport-view');
    }
}
