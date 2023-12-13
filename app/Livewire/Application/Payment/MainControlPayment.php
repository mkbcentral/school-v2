<?php

namespace App\Livewire\Application\Payment;

use App\Livewire\Helpers\Cost\TypeCostHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\TypeOtherCost;
use Livewire\Component;

class MainControlPayment extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
    ];
    public $defaultScolaryYerId;
    public $selectedIndex = 0;
    public bool $isByTranch=false;

    /**
     * Change index for selected Type cost
     * @param TypeOtherCost $type
     * @return void
     */
    public function changeIndex(TypeOtherCost $type): void
    {
        $this->selectedIndex = $type->id;
        $this->isByTranch=$type->is_by_tranch;
        $this->dispatch('typeCostSelected', $this->selectedIndex);
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
     * Mounted component
     * @return void
     */
    public function mount(): void
    {
        $this->defaultScolaryYerId=(new SchoolHelper())->getCurrentScolaryYear()->id;
        $this->isByTranch=(new TypeCostHelper())->getFirstTypeCostActive($this->defaultScolaryYerId)->is_by_tranch;
        $this->selectedIndex=(new TypeCostHelper())->getFirstTypeCostActive($this->defaultScolaryYerId)->id;

    }
    public function render()
    {
        return view('livewire.application.payment.main-control-payment',[
            'listTypeCost'=>(new TypeCostHelper())->getListTypeCost($this->defaultScolaryYerId)
        ]);
    }
}
