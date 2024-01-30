<?php

namespace App\Livewire\Application\Movement;

use App\Livewire\Helpers\Movement\DepositBankHelper;
use App\Livewire\Helpers\SchoolHelper;
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
    #[Rule('nullable')]
    #[Rule('date', message: 'Date création invalide', onUpdate: false)]
    public  $created_at;

    public BankDeposit $bankDeposit;
    public bool $isEditing = false;
    public string $formLabel = 'NOUVEAU DEPOT';

    public function store()
    {
        $fields = $this->validate();

        try {
            $fields['number'] = rand(10000, 100000);
            $fields['scolary_year_id'] = (new SchoolHelper())->getCurrectScolaryYear()->id;
            $fields['school_id'] = Auth::user()->id;
            BankDeposit::create($fields);
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

    public function newBankDeposiMissing(BankDeposit $bankDeposit)
    {
        $this->dispatch('agentBankDeposit', $bankDeposit);
    }

    public function update()
    {
        $fields = $this->validate();
        try {
            $fields['scolary_year_id'] = (new SchoolHelper())->getCurrectScolaryYear()->id;
            $this->bankDeposit->update($fields);
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
            'listBankDeposit' => BankDeposit::where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)->get(),
            'listCurrency' => Currency::all(),
            'total_usd' => DepositBankHelper::getAmountDepositBank('USD'),
            'total_cdf' => DepositBankHelper::getAmountDepositBank('CDF'),
        ]);
    }
}
