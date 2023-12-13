<?php

namespace App\Livewire\Application\Payment\Widget;

use App\Livewire\Helpers\Payment\GetLatePaymentHelper;
use Livewire\Component;

class SumLatePaymentByDateWidget extends Component
{
    protected $listeners = [
        'getLatePaymentByDate' => 'getDate',
    ];
    public string $date;

    public function getDate(string $date){
        $this->date = $date;

    }

    public function mount()
    {
        $this->date = date('Y-m-d');
    }
    public function render()
    {
        return view('livewire.application.payment.widget.sum-late-payment-by-date-widget', [
            'amount' => GetLatePaymentHelper::getSumPaymentByDay($this->date)
        ]);
    }
}
