<?php

namespace App\Livewire\Application\Inscription\Widget;

use App\Livewire\Helpers\Inscription\GetInscriptionWithGrouping;
use App\Livewire\Helpers\SchoolHelper;
use Livewire\Component;

class ListCounterInscriptionByClasseOptionWidget extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'changeDateInscription' => 'changeDate',
    ];
    public int $counter=0;
    public string $day='';
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
    public function mount(): void
    {
        $this->day=date('Y-m-d');
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        $this->defaultScolaryYerId=$scolaryYear->id;
    }
    public function render()
    {
        $inscriptionList=(new GetInscriptionWithGrouping())->getCountInscriptionGroupingByClasseOptionByDate($this->day,$this->defaultScolaryYerId);
        return view('livewire.application.inscription.widget.list-counter-inscription-by-classe-option-widget',['inscriptionList'=>$inscriptionList]);
    }
}
