<?php

namespace App\Livewire\Application\Inscription\Forms;

use App\Models\Classe;
use App\Models\CostInscription;
use App\Models\Inscription;
use App\Models\StudentResponsable;
use Livewire\Component;

class EditClasseAndInscription extends Component
{
    protected $listeners = ['inscriptionToEdit' => 'getInscription'];
    public  $inscription = null;
    public $classe_id=0,$cost_inscription_id=0,$created_at='',$student_responsable_id;
    public $costInscriptionList = [],$famillyList=[];

    public function getInscription(Inscription $inscription)
    {
        $this->inscription=null;
        $this->inscription = $inscription;
    }

    public function mount()
    {
        $this->costInscriptionList = CostInscription::where('school_id', auth()->user()->school->id)
            ->orderBy('created_at', 'DESC')->get();
        $this->famillyList=StudentResponsable::orderBy('created_at', 'DESC')->get();
    }
    public function update(){
        $this->inscription->classe_id=$this->classe_id;
        $this->inscription->created_at=$this->created_at;
        $this->inscription->cost_inscription_id=$this->cost_inscription_id;
        $this->inscription->update();
        $this->inscription->student->student_responsable_id=$this->student_responsable_id;
        $this->inscription->student->update();
        $this->dispatch('updated', ['message' => "Info bien mise jour!"]);
        $this->dispatch('refreshListInscription');
        $this->dispatch('refreshListResponsible');
        $this->dispatch('refreshSudentList');
    }
    public function render()
    {
        $this->classe_id=$this->inscription?->classe_id;
        $this->created_at=$this->inscription?->created_at->format('Y-m-d');
        $this->cost_inscription_id=$this->inscription?->cost_inscription_id;
        $classeList = Classe::join('classe_options', 'classe_options.id', '=', 'classes.classe_option_id')
            ->join('sections', 'sections.id', '=', 'classe_options.section_id')
            ->join('schools', 'schools.id', '=', 'sections.school_id')
            ->where('sections.school_id', auth()->user()->school->id)
            ->where('classes.classe_option_id',$this->inscription?->classe->classeOption->id)
            ->select('classes.*')
            ->get();
        return view('livewire.application.inscription.forms.edit-classe-and-inscription',['classeList'=>$classeList]);
    }
}
