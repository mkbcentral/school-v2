<?php

namespace App\Livewire\Application\Payment\Form;

use App\Livewire\Helpers\Cost\CostGeneralHelper;
use App\Livewire\Helpers\Payment\CreatePaymentCheckerHelper;
use App\Livewire\Helpers\Payment\CreateNewPaymentHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AddNewPayment extends Component
{
    #[Rule('required|numeric',message:'Le type de frais obligatoire')]
    public $type_other_cost_id;
    #[Rule('required|string',message:'Le mois est obligatoire')]
    public $month;
    #[Rule('required|numeric',message:'Le frais est obligatoire')]
    public $cost_general_id;

    public ?Inscription $inscription = null;
    public string $amountLabel = '';
    public string $currency = '';
    public int $selectedTypeCost=0;

    protected $listeners =
    [
        'studentPayment' => 'getStudent',
    ];

    public function updatedTypeOtherCostId($val): void
    {
        $this->type_other_cost_id = $val;
        $this->selectedTypeCost=$val;
    }

    public function updatedCostGeneralId($val): void
    {
        $this->amountLabel = CostGeneralHelper::getCostById($val)->amount;
        $this->currency = CostGeneralHelper::getCostById($val)->currency->currency;
    }
    public function getStudent(Inscription $inscription): void
    {
        $this->inscription = $inscription;
    }
    public function store(): void
    {
        $this->validate();
        //Get payment existing payment
        $paymentChecker = CreatePaymentCheckerHelper::checkIfPaymentExistBeforCreate(
            $this->inscription->student->id,
            $this->month,
            $this->cost_general_id,
            (new SchoolHelper())->getCurrentScolaryYear()->id
        );
        //Check if student has payment
        if ($paymentChecker) {
            $this->dispatch('error', ['message' => 'Désolé,cet élève a déjà un paiement pour ce mois']);
        } else {
            CreateNewPaymentHelper::create(
                $this->month,
                $this->cost_general_id,
                $this->inscription->classe->classeOption->id,
                $this->inscription->id,
                $this->inscription->student->id,
                (new SchoolHelper())->getCurrentScolaryYear()->id,
                $this->inscription->classe->id
            );
            $this->dispatch('paymentListRefresh');
            $this->dispatch('added', ['message' => 'Action bien réalisée']);
        }
    }


    public function mount(): void
    {
        $this->month = date('m');
    }
    public function render()
    {
        return view('livewire.application.payment.form.add-new-payment');
    }
}
