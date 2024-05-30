<?php

namespace App\Livewire\Application\Payment\List;

use App\Models\CostGeneral;
use App\Models\Payment;
use Livewire\Component;

class ExemptPaymentList extends Component
{
    public  $month = '';
    public $costs;
    public  $idCost;

    public function mount()
    {
        $this->month = date('m');
        $this->idCost = 59;
        $this->costs = CostGeneral::query()->whereIn('id', [59, 83])->get();
    }


    public function render()
    {
        return view('livewire.application.payment.list.exempt-payment-list', [
            'payments' => Payment::join('students', 'students.id', '=', 'payments.student_id')
                ->join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
                ->join('rates', 'rates.id', '=', 'payments.rate_id')
                ->where('payments.scolary_year_id', 2)
                ->where('payments.month_name', $this->month)
                ->where('cost_generals.type_other_cost_id', 11)
                ->where('cost_general_id', $this->idCost)
                ->where('students.school_id', auth()->user()->school->id)
                ->orderBy('payments.created_at', 'DESC')
                ->where('payments.is_paid', true)
                ->with(['cost.currency', 'student.studentResponsable', 'inscription.classe.classeOption', 'inscription.scolaryYear'])
                ->select('payments.*', 'cost_generals.amount as amount')
                ->get()
        ]);
    }
}
