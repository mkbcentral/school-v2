<?php

namespace App\Livewire\Application\Rapport;

use App\Livewire\Helpers\Cost\TypeCostHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\ClasseOption;
use App\Models\TypeOtherCost;
use Livewire\Component;

class PaymentRapport extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
    ];
    public string $keyToSearch = '';
    public $defaultScolaryYerId;
    public $listTypeCost=[];
    public $selectedIndex = 0;
    public  $status=true;
    public $isActive=true;

    /**
     * Change index for selected Type cost
     * @param TypeOtherCost $type
     * @return void
     */
    public function changeIndex(TypeOtherCost $type): void
    {
        $this->selectedIndex = $type->id;
        $this->dispatch('selectedIndexFresh', $this->selectedIndex);
        $this->isActive=!$this->isActive;
    }

    /**
     * Get selected scolaryYear id with emit ScolaryYearWidget listener
     * @param $id
     * @return void
     */
    public function getScolaryYear($id): void
    {
        $this->defaultScolaryYerId = $id;
        $this->status =!$this->status;
    }

    /**
     * Mounted component
     * @return void
     */
    public function mount(): void
    {
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        $this->defaultScolaryYerId=$scolaryYear->id;

        $defaultTypeCost=(new TypeCostHelper())->getFirstTypeCostActive($scolaryYear->id,$this->isActive);
        $this->selectedIndex=$defaultTypeCost->id;
    }
    public function render()
    {
        $this->listTypeCost=(new TypeCostHelper())
            ->getListTypeCost($this->defaultScolaryYerId);
        return view('livewire.application.rapport.payment-rapport');
    }
}
