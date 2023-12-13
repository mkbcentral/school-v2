<?php

namespace App\Livewire\Application\Payment\List;

use App\Livewire\Helpers\Inscription\GetAllInscriptionHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class ListStudentForPayment extends Component
{
    use WithPagination;
    public $keySearch = '';
    
    public function show(Inscription $inscription){
        $this->dispatch('studentPayment', $inscription);
        $this->dispatch('paymentsByInscription', $inscription);
    }
    public function mount()
    {
       
    }
    public function render()
    {
        return view('livewire.application.payment.list.list-student-for-payment',
        ['listInscription'=>GetAllInscriptionHelper::getListInscriptionForCurrentYear($this->keySearch)]);
    }
}
