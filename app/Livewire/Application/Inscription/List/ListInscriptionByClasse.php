<?php

namespace App\Livewire\Application\Inscription\List;

use App\Livewire\Helpers\Inscription\GetAllInscriptionHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Classe;
use App\Models\Inscription;
use App\Models\Student;
use Livewire\Component;

class ListInscriptionByClasse extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'refreshListInscription' => '$refresh',
        'selectedClasseOption' => 'getOptionSelected',
        'deleteInscriptionListner' => 'delete'
    ];

    public $keyToSearch = '';
    public $classeId;
    public $inscriptions;
    public $classeData;
    public $idInscription;
    public $selectedIndex = 0;

    public function edit(Inscription $inscription)
    {
        $this->selectedIndex = $inscription->classe->classeOption->id;
        $this->dispatch('studentAndInscription', $inscription->student);
    }
    public function editInscription(Inscription $inscription)
    {
        $this->dispatch(
            'inscriptionToEdit',
            $inscription,
            $this->selectedIndex == 0 ?
                $inscription->classe->classeOption->id :
                $this->selectedIndex
        );
    }

    public function showDeleteDialog(string $idInscription)
    {
        $this->idInscription = $idInscription;
        $this->dispatch('delete-inscription-dialog');
    }
    public function delete()
    {
        $inscription = Inscription::find($this->idInscription);
        $student = Student::find($inscription->student_id);
        $scolayYear = (new SchoolHelper())->getCurrentScolaryYear();
        if ($inscription->payments->isEmpty()) {
            $inscription->delete();
            if ($student->scolaryYear->id == $scolayYear->id) {
                $student->delete();
            }
            $this->dispatch('inscription-deleted', ['message' => "Inscription bien rétirée !"]);
        } else {
            $this->dispatch('inscription-deleted', ['message' => "Impossible, Cette inscription a déjà des données utilisée dans le système"]);
        }
    }


    public function mount($classe)
    {
        $this->classeId = $classe;
        $this->classeData = Classe::find($classe);
    }
    public function render()
    {
        $this->inscriptions = GetAllInscriptionHelper::getListInscriptionByClasseForCurrentYear($this->classeId, $this->keyToSearch);
        return view('livewire.application.inscription.list.list-inscription-by-classe');
    }
}
