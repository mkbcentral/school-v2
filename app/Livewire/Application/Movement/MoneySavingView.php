<?php

namespace App\Livewire\Application\Movement;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\Currency;
use App\Models\MoneySaving;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class MoneySavingView extends Component
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

    public MoneySaving $moneySaving;
    public bool $isEditing = false;
    public string $formLabel = 'NOUVEAU DEPOT';

    public function store()
    {
        $this->validate();
        try {
            MoneySaving::create([
                'month_name' => $this->month_name,
                'amount' => $this->amount,
                'number' => rand(10000, 100000),
                'school_id' => Auth::user()->id,
                'scolary_year_id' => (new SchoolHelper())->getCurrectScolaryYear()->id,
                'currency_id' => $this->currency_id
            ]);
            $this->dispatch('added', ['message' => 'Action bien réalisée']);
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }

    public function edit(moneySaving $moneySaving)
    {
        $this->moneySaving = $moneySaving;
        $this->isEditing = true;
        $this->amount = $moneySaving->amount;
        $this->currency_id = $moneySaving->currency_id;
        $this->month_name = $moneySaving->month_name;
        $this->created_at = $moneySaving->created_at->format('Y-m-d');
        $this->formLabel = 'EDITION DEPOT';
    }

    public function update()
    {
        $this->validate();
        try {
            $this->moneySaving->month_name = $this->month_name;
            $this->moneySaving->currency_id = $this->currency_id;
            $this->moneySaving->amount = $this->amount;
            $this->moneySaving->created_at = $this->created_at;
            $this->moneySaving->scolary_year_id = (new SchoolHelper())->getCurrectScolaryYear()->id;
            $this->moneySaving->update();
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

    public function delete(MoneySaving $moneySaving)
    {
        try {
            $moneySaving->delete();
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
        return view('livewire.application.movement.money-saving-view', [
            'listMoneySaving' => MoneySaving::where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)->get(),
            'listCurrency' => Currency::all()
        ]);
    }
}
