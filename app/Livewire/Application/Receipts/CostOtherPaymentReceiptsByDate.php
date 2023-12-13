<?php

namespace App\Livewire\Application\Receipts;

use App\Livewire\Helpers\Payment\GetAmountPaymentGroupingByTypeCost;
use App\Livewire\Helpers\SchoolHelper;
use Livewire\Component;

class CostOtherPaymentReceiptsByDate extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'changeDateInscription' => 'changeDate',
    ];
    public int $counter=0;
    public string $day='',$defaultCureencyName;
    public int $defaultScolaryYerId;
    /**
     * Mounted component
     * @return void
     */

    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }

    public function changeDate($date)
    {
        $this->day=$date;
    }

    /**
     * Get selected currency with emit CurrencyWidget listener
     * @param $currency
     * @return void
     */
    public  function  getCurrency($currency): void
    {
        $this->defaultCureencyName=$currency;
    }
    public function mount(): void
    {
        $this->day=date('Y-m-d');
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        $this->defaultScolaryYerId=$scolaryYear->id;
        $defaultCurrency = (new SchoolHelper())->getCurrentCurrency();
        $this->defaultCureencyName=$defaultCurrency->currency;
    }
    public function render()
    {
        $listReceipt=GetAmountPaymentGroupingByTypeCost::getAmountPaymentByDate($this->day,$this->defaultScolaryYerId);
        return view('livewire.application.receipts.cost-other-payment-receipts-by-date',['listReceipt'=>$listReceipt]);
    }
}
