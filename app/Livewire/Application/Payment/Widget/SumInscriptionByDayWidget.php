<?php

namespace App\Livewire\Application\Payment\Widget;

use App\Livewire\Helpers\Inscription\GetInscriptionByDateWithPaymentStatusHelper;
use Livewire\Component;

class SumInscriptionByDayWidget extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'refreshSumByDayInscription' => '$refresh',
        'changeDateSumInscription' => 'changeDate',
    ];
    public $total=0,$date_to_search;
    public  $defaultScolaryYerId,$defaultCureencyName,$classe_id = 0;

    /**
     * Get scolaryYearId with emit in scolaryYearWidget listener
     * @param $id
     * @return void
     */
    public function getScolaryYear($id): void
    {
        $this->defaultScolaryYerId = $id;
    }

    /**
     * Get date to send in child component
     * @param $date
     * @return void
     */
    public function changeDate($date): void
    {
        $this->date_to_search=$date;
    }
    /**
     * Get currency name with emit in currencyWidget listener
     * @param $currency
     * @return void
     */
    public  function  getCurrency($currency){
        $this->defaultCureencyName=$currency;
    }

    /**
     *mount component
     * @param $date
     * @param $defaultScolaryYerId
     * @param $classeId
     * @param $currency
     * @return void
     */
    public function mount($date,$defaultScolaryYerId,$classeId,$currency): void
    {
        $this->date_to_search=$date;
        $this->defaultScolaryYerId=$defaultScolaryYerId;
        $this->classe_id=$classeId;
        $this->defaultCureencyName=$currency;
    }
    public function render()
    {
        $this->total= (new GetInscriptionByDateWithPaymentStatusHelper())
            ->getSumTotalAmountInscriptionByDate($this->date_to_search, $this->defaultScolaryYerId, $this->classe_id, 0,$this->defaultCureencyName,true);
        return view('livewire.application.payment.widget.sum-inscription-by-day-widget',['total'=>$this->total]);
    }
}
