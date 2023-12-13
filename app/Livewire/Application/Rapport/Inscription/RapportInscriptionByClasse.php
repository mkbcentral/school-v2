<?php

namespace App\Livewire\Application\Rapport\Inscription;

use App\Livewire\Helpers\Cost\TypeCostHelper;
use App\Livewire\Helpers\DateFormatHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\ClasseOption;
use App\Models\TypeOtherCost;
use Livewire\Component;

class RapportInscriptionByClasse extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
    ];
    public $listClasseOption = [];
    public $selectedIndex = 0,$selectedOtherCostIndex=0, $selectedClasseOption;
    public $defaultScolaryYerId;
    public $classeList;
    public $listTYpeCost = [];
    public $months = [], $month;

    /**
     * Reset date to search on null after month property is updated
     * @return void
     */
    public function updatedMonth($val): void
    {
        $this->month=$val;
    }

    public function mount()
    {
        $this->months = (new DateFormatHelper())->getMonthsForYear();
        $this->month = date('m');
        $this->selectedIndex =  ClasseOption::first()->id;
        $this->listClasseOption = (new SchoolHelper())->getListClasseOption();
        $this->defaultScolaryYerId = (new SchoolHelper())->getCurrentScolaryYear()->id;
        $this->listTYpeCost = (new TypeCostHelper())->getListTypeCost($this->defaultScolaryYerId);
        $this->selectedOtherCostIndex =(new TypeCostHelper())->getFirstTypeCostActive($this->defaultScolaryYerId)->id;
    }
    public function changeIndex(ClasseOption $option)
    {
        $this->selectedIndex = $option->id;
        $this->selectedClasseOption = $option;
        $this->dispatch('selectedClasseOption', $this->selectedIndex);;
    }

    public function changeIndexTypeCost(TypeOtherCost $typeOtherCost){
        $this->selectedOtherCostIndex=$typeOtherCost->id;
    }
    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }

    public function render()
    {
        $this->classeList = (new SchoolHelper())->getListClasseByOption($this->selectedIndex);
        return view('livewire.application.rapport.inscription.rapport-inscription-by-classe');
    }
}
