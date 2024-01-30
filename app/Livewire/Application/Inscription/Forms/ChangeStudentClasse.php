<?php

namespace App\Livewire\Application\Inscription\Forms;

use App\Livewire\Helpers\Cost\CostInscriptionHelper;
use App\Livewire\Helpers\Inscription\CreateNewInscriptionHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use App\Models\StudentChangeClasse;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ChangeStudentClasse extends Component
{
    protected $listeners = ['inscriptionTochange' => 'getInscription'];
    public  $inscription = null;

    #[Rule('required', message: 'Champs type inscription obligation', onUpdate: false)]
    public $cost_inscription_id;
    #[Rule('required', message: 'Champs option obligation', onUpdate: false)]
    public $classe_id;
    #[Rule('required', message: 'Champs classe obligation', onUpdate: false)]
    public $classe_option_id;


    public function getInscription(Inscription $inscription)
    {
        $this->inscription = null;
        $this->inscription = $inscription;
    }
    public function changeClasse()
    {
        $this->validate();
        try {
            $newInscriprtion =  (new CreateNewInscriptionHelper())
                ->create(
                    (new SchoolHelper())->getCurrectScolaryYear()->id,
                    $this->cost_inscription_id,
                    $this->inscription->student->id,
                    $this->classe_id,
                    $this->classe_option_id,
                    true
                );
            $this->inscription->is_changed_classe = true;
            $this->inscription->update();
            StudentChangeClasse::create([
                'changed_inscription_id' => $this->inscription->id,
                'new_inscription_id' => $newInscriprtion->id,
                'school_id' => Auth::id(),
                'scolary_year_id' => (new SchoolHelper())->getCurrectScolaryYear()->id,
            ]);
            $this->dispatch('updated', ['message' => "Elève bien basculté !"]);
            $this->dispatch('refreshListInscription');
            $this->dispatch('close-change-student-classe-modal');
        } catch (Exception $ex) {
            $this->dispatch('error', ['message' => $ex->getMessage()]);
        }
    }
    public function render()
    {
        return view('livewire.application.inscription.forms.change-student-classe', [
            'classes' => (new SchoolHelper())->getListClasseByOption($this->classe_option_id),
            'classeOptions' => (new SchoolHelper())->getListClasseOption(),
            'costInscriptions' => (new CostInscriptionHelper())->getListCostInscription()
        ]);
    }
}
