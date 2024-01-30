<?php

namespace App\Livewire\Application\Movement;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\AgentSalary;
use App\Models\Currency;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AgentSalaryView extends Component
{

    #[Rule('required', message: 'Mois obligation', onUpdate: false)]
    public string $month_name = '';
    public  $created_at;
    public AgentSalary $agentSalary;
    public bool $isEditing = false;
    public string $formLabel = 'NOUVEAU MOUVEAU SALAIRE';

    public function store()
    {
        $this->validate();
        try {
            AgentSalary::create([
                'month_name' => $this->month_name,
                'number' => rand(10000, 100000),
                'school_id' => Auth::user()->id,
                'scolary_year_id' => (new SchoolHelper())->getCurrectScolaryYear()->id,
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
        $this->month_name = $agentSalary->month_name;
        $this->created_at = $agentSalary->created_at->format('Y-m-d');
        $this->formLabel = 'EDITION MOUVEMENT SALAIRE';
    }

    public function show(AgentSalary $agentSalary)
    {
        $this->dispatch('agentSalaryData', $agentSalary);
    }

    public function update()
    {
        $this->validate();
        try {
            $this->agentSalary->month_name = $this->month_name;
            $this->agentSalary->scolary_year_id = (new SchoolHelper())->getCurrectScolaryYear()->id;
            $this->agentSalary->created_at = $this->created_at;
            $this->agentSalary->update();
            $this->dispatch('updated', ['message' => 'Action bien réalisée']);
            $this->month_name = '';
            $this->formLabel = 'NOUVEAU DEPOT';
            $this->isEditing = false;
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
        if ($this->isEditing == false) {
            $this->store();
        } else {
            $this->update();
        }
    }
    public function render()
    {
        return view('livewire.application.movement.agent-salary-view', [
            'ListAgentSalary' => AgentSalary::where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)->get(),
            'listCurrency' => Currency::all()
        ]);
    }
}
