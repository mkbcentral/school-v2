<?php

namespace App\Livewire\Application\Movement;

use App\Models\BankDeposit;
use App\Models\Currency;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class BankDepositView extends Component
{

    #[Rule('required', message: 'Montant obligation', onUpdate: false)]
    #[Rule('numeric', message: 'Le montant doit être numerique', onUpdate: false)]
    public string $amount = '';
    #[Rule('required', message: 'Mois obligation', onUpdate: false)]
    public string $month_name = '';
    #[Rule('required', message: 'Devise obligation', onUpdate: false)]
    #[Rule('numeric', message: 'Id devise doit être numeric', onUpdate: false)]
    public string $currency_id = '';


    public  $created_at;

    public BankDeposit $bankDeposit;
    public bool $isEditing = false;
    public string $formLabel = 'NOUVEAU DEPOT';

    public function store()
    {
        $this->validate();

        try {
            BankDeposit::create([
                'month_name' => $this->month_name,
                'amount' => $this->amount,
                'number' => rand(10000, 100000),
                'school_id' => Auth::user()->id,
                'currency_id' => $this->currency_id
            ]);
            $this->dispatch('added', ['message' => 'Action bien réalisée']);
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }

    public function edit(BankDeposit $bankDeposit)
    {
        $this->bankDeposit = $bankDeposit;
        $this->isEditing = true;
        $this->amount = $bankDeposit->amount;
        $this->currency_id = $bankDeposit->currency_id;
        $this->month_name = $bankDeposit->month_name;
        $this->created_at = $bankDeposit->created_at->format('Y-m-d');
        $this->formLabel = 'EDITION DEPOT';
    }

    public function update()
    {
        $this->validate();
        try {
            $this->bankDeposit->month_name = $this->month_name;
            $this->bankDeposit->currency_id = $this->currency_id;
            $this->bankDeposit->amount = $this->amount;
            $this->bankDeposit->created_at = $this->created_at;
            $this->bankDeposit->update();
            $this->dispatch('updated', ['message' => 'Action bien réalisée']);
            $this->amount = '';
            $this->currency_id = '';
            $this->month_name = '';
            $this->formLabel = 'NOUVEAU DEPOT';
            $this->isEditing = false;
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }

    public function delete(BankDeposit $bankDeposit)
    {
        try {
            $bankDeposit->delete();
            $this->dispatch('updated', ['message' => 'Action bien réalisée']);
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

    public function render()
    {
        return view('livewire.application.movement.bank-deposit-view', [
            'listBankDeposit' => BankDeposit::all(),
            'listCurrency' => Currency::all()
        ]);
    }
}
