<?php

namespace App\Livewire\Application\School;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\Currency;
use Livewire\Component;

class CurrencyWidget extends Component
{
    public $defaulCurrency;
    public $currency_id;

    public function updatedCurrencyId($val){
        $this->dispatch('CurrancyFresh', $val);

    }

    public function mount(){
        $this->defaulCurrency=(new SchoolHelper())->getCurrentCurrency();
    }

    public function render()
    {
        $listCurrencies=Currency::where('school_id',auth()->user()->school->id)
            ->orderBy('currency','ASC')
            ->get();
        return view('livewire.application.school.currency-widget',['listCurrencies'=>$listCurrencies]);
    }
}
