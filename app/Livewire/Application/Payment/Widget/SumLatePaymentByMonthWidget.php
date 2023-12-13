<?php

namespace App\Livewire\Application\Payment\Widget;

use App\Livewire\Helpers\Payment\GetLatePaymentHelper;
use Livewire\Component;

class SumLatePaymentByMonthWidget extends Component
{
    protected $listeners = [
        'getLatePaymentByMonth' => 'getMonth',
    ];
    public string $month;

    public function getMonth(string $month){
        $this->month = $month;
    }

    public function mount()
    {
        $this->month = date('m');
    }
    public function render()
    {
        return view('livewire.application.payment.widget.sum-late-payment-by-month-widget', [
            'amount' => GetLatePaymentHelper::getSumPaymentByMonth($this->month)
        ]);
    }
}
