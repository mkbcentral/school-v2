<?php

namespace App\Livewire\Application\Movement;

use App\Models\AgentSalary;
use App\Models\Currency;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AgentSalaryView extends Component
{
    #[Rule('required', message: 'Montant obligation', onUpdate: false)]
    #[Rule('numeric', message: 'Le montant doit être numerique', onUpdate: false)]
    public string $amount = '';
    #[Rule('required', message: 'Mois obligation', onUpdate: false)]
    public string $month_name = '';
    #[Rule('required', message: 'Devise obligation', onUpdate: false)]
    #[Rule('numeric', message: 'Id devise doit être numeric', onUpdate: false)]
    public string $currency_id = '';

    public AgentSalary $agentSalary;
    public bool $isEditing = false;
    public string $formLabel='NOUVEAU MOUVEAU SALAIRE';

    public function store()
    {
        $this->validate();
        try {
            AgentSalary::create([
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

    public function edit(AgentSalary $agentSalary)
    {
        $this->agentSalary = $agentSalary;
        $this->isEditing = true;
        $this->amount = $agentSalary->amount;
        $this->currency_id = $agentSalary->currency_id;
        $this->month_name = $agentSalary->month_name;
        $this->formLabel='EDITION MOUVEMENT SALAIRE';
    }

    public function update()
    {
        $this->validate();
        try {
            $this->agentSalary->month_name = $this->month_name;
            $this->agentSalary->currency_id = $this->currency_id;
            $this->agentSalary->amount = $this->amount;
            $this->agentSalary->update();
            $this->dispatch('updated', ['message' => 'Action bien réalisée']);
            $this->amount = '';
            $this->currency_id = '';
            $this->month_name = '';
            $this->formLabel='NOUVEAU DEPOT';
            $this->isEditing=false;
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }

    public function delete(AgentSalary $agentSalary)
    {
        try {
            $agentSalary->delete();
            $this->dispatch('updated', ['message' => 'Action bien réalisée']);
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }

    public function handlerSubmit()
    {
        if ($this->isEditing==false) {
            $this->store();
        }else{
            $this->update();
        }
    }
    public function render()
    {
        return view('livewire.application.movement.agent-salary-view',[
            'ListAgentSalary' => AgentSalary::all(),
            'listCurrency' => Currency::all()
        ]);
    }
}
