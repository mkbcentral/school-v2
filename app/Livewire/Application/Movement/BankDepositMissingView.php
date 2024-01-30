<?php

namespace App\Livewire\Application\Movement;

use App\Models\BankDeposit;
use App\Models\BankDepositMissing;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Component;

class BankDepositMissingView extends Component
{
    protected $listeners =
    [
        'agentBankDeposit' => 'getBankDeposit',
    ];

    #[Rule('required', message: 'Nom obligation', onUpdate: false)]
    public string $description = '';
    #[Rule('required', message: 'Montant obligation', onUpdate: false)]
    #[Rule('numeric', message: 'Le montant doit être numerique', onUpdate: false)]
    public string $amount = '';

    public ?BankDepositMissing $bankDepositMissing = null;
    public ?BankDeposit $bankDeposit = null;
    public bool $isEditing = false;
    public string $labelForm = 'AJOUTER LE DETAIL';

    public function store()
    {
        $this->validate();
        try {
            BankDepositMissing::create([
                'amount' => $this->amount,
                'description' => $this->description,
                'bank_deposit_id' => $this->bankDeposit->id
            ]);
            $this->dispatch('added', ['message' => 'Action bien réalisée']);
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }

    public function getBankDeposit(?BankDeposit $bankDeposit)
    {
        $this->bankDeposit = $bankDeposit;
        if ($this->bankDeposit->bankDepositMissing) {
            $this->bankDepositMissing = $this->bankDeposit->bankDepositMissing;
            $this->isEditing = true;
            $this->description = $this->bankDeposit->bankDepositMissing->description;
            $this->amount = $this->bankDeposit->bankDepositMissing->amount;
        }
    }

    public function edit(BankDepositMissing $bankDepositMissing)
    {
        $this->description = $bankDepositMissing->description;
        $this->amount = $bankDepositMissing->amount;
        $this->bankDepositMissing = $bankDepositMissing;
        $this->isEditing = true;
        $this->labelForm = 'EDITION DETAIL';
    }

    public function update()
    {
        $this->validate();
        try {
            $this->bankDepositMissing->description = $this->description;
            $this->bankDepositMissing->amount = $this->amount;
            $this->bankDepositMissing->update();
            $this->dispatch('added', ['message' => 'Action bien réalisée']);
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }
    public function handlerSubmit()
    {
        if ($this->isEditing == false) {
            $this->store();
        } else {
            $this->update();
        }
    }
    public function delete(bankDepositMissing $bankDepositMissing)
    {
        try {
            $bankDepositMissing->delete();
            $this->dispatch('error', ['message' => 'Action bien réalisée']);
            $this->bankDepositMissing = null;
            $this->isEditing = false;
            $this->amount = '';
            $this->description = '';
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }
    public function render()
    {
        return view('livewire.application.movement.bank-deposit-missing-view', [
            ''
        ]);
    }
}
