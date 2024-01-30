<?php

namespace App\Livewire\Application\Payment\List;

use App\Livewire\Helpers\Payment\GetPaymentByMonthHelper;
use App\Livewire\Helpers\SchoolHelper;
use Livewire\Component;

class ListPaymentForLastMonth extends Component
{
    public  $month, $next_month;
    public $type_other_cost_id, $cost_general_id;
    public $selectedTypeCost = 0;

    public function updatedTypeOtherCostId($val)
    {
        $this->selectedTypeCost = $val;
    }

    public function mount()
    {
        $this->month = date('m');
    }

    public function render()
    {
        return view('livewire.application.payment.list.list-payment-for-last-month', [
            'payments' => GetPaymentByMonthHelper::getLatePayments(
                $this->month,
                $this->next_month,
                (new SchoolHelper())->getCurrectScolaryYear()->id,
                $this->type_other_cost_id,
            )
        ]);
    }
}
