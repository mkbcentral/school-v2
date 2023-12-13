<?php

namespace App\Livewire\Application\Payment\List;

use App\Livewire\Helpers\Payment\GetPaymentByDateHelper;
use App\Livewire\Helpers\Printing\PosPrintingHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Currency;
use App\Models\Payment;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class ListPaymentByDay extends Component
{
    protected $listeners = [
        'paymentListRefresh' => '$refresh',
        'scolaryYearFresh' => 'getScolaryYear',
        'deletePaymentListner'=>'delete'
    ];
     public $keyToSearch='',$date_to_search,$defaultCureencyName;
    public $defaultScolaryYerId;
    public $idPayment;

    public function updatedDateToSearch($val){
        $this->dispatch('changeDatePayment',$val);
    }
    public function getScolaryYear($id):void
    {
        $this->defaultScolaryYerId = $id;
    }

    public  function  getCurrency($currency):void{
        $this->defaultCureencyName=$currency;
    }

    public function edit(Payment $payment): void
    {
        $this->dispatch('paymentToEdit',$payment);

    }
    public function printBill(Payment $payment):void{;
        if($payment->is_paid==true){
            $payment->is_paid=false;
            //(new PosPrintingHelper())->printPayment($payment,$this->defaultCureencyName);
        }else{
            $payment->is_paid=true;
        }
        $payment->update();
        $this->dispatch('refreshSumByDayPayment');
        $this->dispatch('added', ['message' => "Action réalisée avec succès !"]);
    }
    public function showDeleteDialog(string $idPayment){
        $this->idPayment=$idPayment;
        $this->dispatch('delete-payment-dialog');
    }
    public function delete(){
        $payment=Payment::find($this->idPayment);
        $payment->delete();
        $this->dispatch('payment-deleted', ['message' => "Payment bien rétiré !"]);
    }
    public function mount(): void
    {
        $this->defaultScolaryYerId=(new SchoolHelper())->getCurrentScolaryYear()->id;
        $this->date_to_search = date('Y-m-d');

    }

    public function render()
    {
        return view('livewire.application.payment.list.list-payment-by-day',
        ['listPayments'=>GetPaymentByDateHelper::getDatePayments(
            $this->date_to_search,
            $this->defaultScolaryYerId,
            0,
            0,
            0,
            $this->keyToSearch,
           )]);
    }
}
