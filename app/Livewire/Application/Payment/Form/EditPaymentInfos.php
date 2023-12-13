<?php

namespace App\Livewire\Application\Payment\Form;

use App\Livewire\Helpers\Cost\CostGeneralHelper;
use App\Livewire\Helpers\DateFormatHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Payment;
use Livewire\Component;

class EditPaymentInfos extends Component
{
    protected $listeners = ['paymentToEdit' => 'getPayment','scolaryYearFresh' => 'getScolaryYear',];
    public $payment=null;
    public $cost_other_id=0,$created_at,$defaultScolaryYerId;
    public $months=[],$month,$listOtherCost=[];
    public function getPayment(Payment $payment)
    {
        $this->payment = $payment;
    }
    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }
    public function mount(){
        $this->months=(new DateFormatHelper())->getMonthsForYear();
        $defaultScolaryYer = (new SchoolHelper())->getCurrentScolaryYear();
        $this->defaultScolaryYerId=$defaultScolaryYer->id;
    }
    public function update(){
        $this->validateForm();
        $this->payment->cost_general_id=$this->cost_other_id;
        $this->payment->month_name=$this->month;
        $this->payment->created_at=$this->created_at;
        $this->payment->update();
        $this->dispatch('paymentListRefresh');
        $this->dispatch('updated',['message'=>'Infos bien mise à jour']);
    }
    public function validateForm(){
        $this->validate([
            'month' => ['required', 'string'],
            'cost_other_id' => ['required', 'numeric'],
            'created_at' => ['required', 'date'],
        ]);
    }
    public function render()
    {
        $this->cost_other_id=$this->payment?->cost_general_id;
        $this->month=$this->payment?->month_name;
        $this->created_at=$this->payment?->created_at->format('Y-m-d');

        $this->listOtherCost=(new CostGeneralHelper())
                ->getListCostGeneral($this->payment?->cost->typeOtherCost->id,$this->defaultScolaryYerId);
        return view('livewire.application.payment.form.edit-payment-infos');
    }
}
