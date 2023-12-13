<?php

namespace App\Livewire\Application\Depense\Widget;

use App\Livewire\Helpers\Depense\EmpruntHelper;
use Livewire\Component;

class AmountEmpruntByCurrencyWidget extends Component
{
    public string $month;
    protected $listeners = [
        'getMonthEmprunt' => 'getMothn'
    ];
    public function getMothn(string $month)
    {
        $this->month = $month;
    }

    public function mount()
    {
        $this->month=date('m');
    }
    public function render()
    {
        return view('livewire.application.depense.widget.amount-emprunt-by-currency-widget',
        ['listEmprunt' => EmpruntHelper::getAmountEmpruntGroupingByCurrency($this->month)]);
    }
}
