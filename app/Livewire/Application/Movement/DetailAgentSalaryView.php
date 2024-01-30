<?php

namespace App\Livewire\Application\Movement;

use App\Models\AgentSalary;
use App\Models\AgentSalaryDetail;
use App\Models\Currency;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Component;

class DetailAgentSalaryView extends Component
{
    protected $listeners =
    [
        'agentSalaryData' => 'getAgentSalary',
    ];

    #[Rule('required', message: 'Nom obligation', onUpdate: false)]
    public string $name = '';
    #[Rule('required', message: 'Montant obligation', onUpdate: false)]
    #[Rule('numeric', message: 'Le montant doit être numerique', onUpdate: false)]
    public string $amount = '';
    #[Rule('required', message: 'Devise obligation', onUpdate: false)]
    #[Rule('numeric', message: 'Id devise doit être numeric', onUpdate: false)]
    public string $currency_id = '';

    public ?AgentSalary $agentSalry = null;
    public ?AgentSalaryDetail $agentSalaryDetail;
    public bool $isEditing=false;
    public string $labelForm='AJOUTER LE DETAIL';

    public function store()
    {
        $this->validate();
        try {
            AgentSalaryDetail::create([
                'amount' => $this->amount,
                'name' => $this->name,
                'currency_id' => $this->currency_id,
                'agent_salary_id' => $this->agentSalry->id
            ]);
            $this->dispatch('added', ['message' => 'Action bien réalisée']);
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }

    public function getAgentSalary(?AgentSalary $agentSalary)
    {
        $this->agentSalry = $agentSalary;
    }

    public function edit(AgentSalaryDetail $agentSalaryDetail)
    {
        $this->name = $agentSalaryDetail->name;
        $this->amount = $agentSalaryDetail->amount;
        $this->currency_id = $agentSalaryDetail->currency_id;
        $this->agentSalaryDetail = $agentSalaryDetail;
        $this->isEditing=true;
        $this->labelForm='EDITION DETAIL';
        
    }

    public function update()
    {
        $this->validate();
        try {
            $this->agentSalaryDetail->name=$this->name;
            $this->agentSalaryDetail->amount=$this->amount;
            $this->agentSalaryDetail->currency_id=$this->currency_id;
            $this->agentSalaryDetail->update();
            $this->dispatch('added', ['message' => 'Action bien réalisée']);
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }
    public function handlerSubmit(){
        if ($this->isEditing==false) {
            $this->store();
        } else {
            $this->update();
        }
        
    }
    public function delete(AgentSalaryDetail $agentSalaryDetail){
        try {
            $agentSalaryDetail->delete();
            $this->dispatch('error', ['message' => 'Action bien réalisée']);
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }
    public function render()
    {
        return view('livewire.application.movement.detail-agent-salary-view', [
            'listCurrency' => Currency::all(),
        ]);
    }
}
