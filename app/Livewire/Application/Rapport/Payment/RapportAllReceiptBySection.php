<?php

namespace App\Livewire\Application\Rapport\Payment;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\Section;
use Illuminate\Support\Collection;
use Livewire\Component;

class RapportAllReceiptBySection extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
    ];
    public ?Collection $listSections;
    public $defaultScolaryYerId,$defaultCureencyName;

    /**
     * Get scolary year id
     * @param $id
     * @return void
     */
    public function getScolaryYear($id): void
    {
        $this->defaultScolaryYerId = $id;
    }

    /**
     * Get currency name
     * @param $currency
     * @return void
     */
    public  function  getCurrency($currency): void
    {
        $this->defaultCureencyName=$currency;
    }
    /**
     * Mounted component
     * @return void
     */
    public function mount(): void
    {
        $this->listSections=Section::all();

    }
    public function render()
    {
        $defaultScolaryYer = (new SchoolHelper())->getCurrentScolaryYear();
        $defaultCurrency =(new SchoolHelper())->getCurrentCurrency();
        $this->defaultScolaryYerId = $defaultScolaryYer->id;
        $this->defaultCureencyName=$defaultCurrency->currency;
        return view('livewire.application.rapport.payment.rapport-all-receipt-by-section');
    }
}
