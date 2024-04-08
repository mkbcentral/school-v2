<?php

namespace App\Livewire\Application\Payment\List;

use App\Livewire\Helpers\DateFormatHelper;
use App\Livewire\Helpers\Inscription\GetListInscriptionByClasseHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\CostGeneral;
use App\Models\TypeOtherCost;
use Livewire\Component;

class ListStudentControlByMonth extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'typeCostSelected' => 'getTypeCost'
    ];
    public $defaultScolaryYerId;
    public $selectedIndex = 0, $classe_id = 0, $classe_option_id = 0, $cost_general_id = 0;
    public $months = [];
    public $typeCost;


    public function updatedClasseId($val): void
    {
        $this->classe_id = $val;
    }

    public function updatedClasseOptionId($val): void
    {
        $this->classe_option_id = $val;
    }
    /**
     * Get selected scolaryYear id with emit ScolaryYearWidget listener
     * @param $id
     * @return void
     */
    public function getScolaryYear($id): void
    {
        $this->defaultScolaryYerId = $id;
    }
    /**
     * Update selectedIndex property for type cost id selected
     * @param $id
     * @return void
     */
    public function getTypeCost($id): void
    {
        $this->selectedIndex = $id;
        $this->typeCost = TypeOtherCost::find($id);
    }

    /**
     * Mounted component
     * @param $selectedIndex
     * @return void
     */
    public function mount($selectedIndex): void
    {
        $this->selectedIndex = $selectedIndex;
        $this->defaultScolaryYerId = (new SchoolHelper())->getCurrentScolaryYear()->id;
        $this->months = (new DateFormatHelper())->getMonthsForScolaryYear();
        $this->typeCost = TypeOtherCost::find($this->selectedIndex);
    }

    public function render()
    {
        return view('livewire.application.payment.list.list-student-control-by-month', [
            'listStudent' => $this->cost_general_id == 0 ? GetListInscriptionByClasseHelper::getListInscrptinForCurrentYear($this->classe_id, $this->defaultScolaryYerId)
                : GetListInscriptionByClasseHelper::getListInscrptinByCostForCurrentYear($this->classe_id, $this->defaultScolaryYerId, $this->cost_general_id),
            'listTypeCost' => CostGeneral::where('type_other_cost_id', $this->selectedIndex)
                ->get()
        ]);
    }
}
