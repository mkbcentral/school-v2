<?php

namespace App\Livewire\Application\Depense\Widget;

use App\Livewire\Helpers\Depense\DepenseHelper;
use App\Livewire\Helpers\Depense\TypeDepenseHelper;
use App\Models\Depense;
use Livewire\Component;

class AmountDepenseByCurrencyWidget extends Component
{
    public string $month;
    public $depense_type_id;
    protected $listeners = [
        'getMonthDepense' => 'getMonth',
    ];
    public function getMonth(string $month)
    {
        $this->month = $month;
    }

    public function mount()
    {
        $this->month = date('m');
        $this->depense_type_id = TypeDepenseHelper::getSchoolType()->id;
    }
    public function render()
    {
        return view(
            'livewire.application.depense.widget.amount-depense-by-currency-widget',
            ['listDepebse' => DepenseHelper::getAmountGoupingByCurrency($this->month, $this->depense_type_id)]
        );
    }
}
