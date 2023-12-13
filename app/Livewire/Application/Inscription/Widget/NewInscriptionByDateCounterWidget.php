<?php

namespace App\Livewire\Application\Inscription\Widget;

use App\Livewire\Helpers\Inscription\GetCounterInscriptionHelper;
use App\Livewire\Helpers\Inscription\GetInscriptionByDateWithPaymentStatusHelper;
use App\Livewire\Helpers\SchoolHelper;
use Livewire\Component;

class NewInscriptionByDateCounterWidget extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'refreshInscriptionByDay'=>'$refresh',
        'changeDateInscription' => 'changeDate',
    ];
    public int $counter=0;
    public string $day='';
    public int $defaultScolaryYerId;
    public $isLoanding=false;
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
    public function mount(): void
    {
        $this->day=date('Y-m-d');
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        $this->defaultScolaryYerId=$scolaryYear->id;
    }
    public function render()
    {
        $this->counter=(new GetCounterInscriptionHelper())
            ->getCountNewInscriptionsByDate($this->day,$this->defaultScolaryYerId);
        return view('livewire.application.inscription.widget.new-inscription-by-date-counter-widget');
    }
}
