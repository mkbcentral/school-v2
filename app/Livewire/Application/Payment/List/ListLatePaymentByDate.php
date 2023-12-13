<?php

namespace App\Livewire\Application\Payment\List;

use App\Livewire\Helpers\DateFormatHelper;
use App\Livewire\Helpers\Payment\GetLatePaymentHelper;
use App\Models\LatePayment;
use Livewire\Component;

class ListLatePaymentByDate extends Component
{
    protected $listeners = [
        'latePaymentListRefresh' => '$refresh',
    ];
    public string $date, $month;
    public array $months = [];
    public bool $isByDate = true;
    public LatePayment $paymentToEdit;
    public $idSeleted = 0, $dateToEdit, $amount;
    public bool $isEditing = false;

    public function updatedDate($val)
    {
        $this->date = $val;
        $this->dispatch('getLatePaymentByDate',$val);
        $this->isByDate = true;
    }
    public function updatedMonth($val)
    {
        $this->month = $val;
        $this->dispatch('getLatePaymentByMonth',$val);
        $this->isByDate = false;
    }

    public function show(LatePayment $payment, $id)
    {
        $this->paymentToEdit = $payment;
        $this->idSeleted = $id;
        $this->dateToEdit = $payment->created_at->format('Y-m-d');
        $this->amount = $payment->amount;
        $this->isEditing = true;
    }
    public function update($idToloading)
    {
        $this->paymentToEdit->update([
            'created_at' => $this->dateToEdit,
            'amount' => $this->amount
        ]);
        $this->isEditing = false;
        $this->idSeleted = 0;
        $this->dispatch('updated', ['message' => 'Paiement bien mis à jour']);
    }

    public function delete($id){
        $payment=LatePayment::find($id);
        $payment->delete();
        $this->dispatch('error', ['message' => 'Paiement bien retiré']);
    }
    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->month = date('m');
        $this->months = (new DateFormatHelper())->getMonthsForScolaryYear();

    }
    public function render()
    {
        if ($this->isByDate) {
            $listePayment = GetLatePaymentHelper::getPaymentByDate($this->date);
        } else {
            $listePayment = GetLatePaymentHelper::getPaymentByMonth($this->month);
        }
        return view('livewire.application.payment.list.list-late-payment-by-date', [
            'listPayment' => $listePayment
        ]);
    }
}
