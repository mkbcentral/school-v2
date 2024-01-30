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


    public function showDeleteDialog(string $idInscription)
    {
        $this->idInscription = $idInscription;
        $this->dispatch('delete-inscription-dialog');
    }


    public function mount($classe)
    {
        $this->classeId = $classe;
        $this->classeData = Classe::find($classe);
    }

    public function getInscription(Inscription $inscription)
    {
        $this->dispatch('InscriptionData', $inscription);
        $this->dispatch('paymentsByInscription', $inscription);
    }

    public function edit(Student $student)
    {
        $this->dispatch('studentAndInscription', $student);
    }
    public function editInscription(Inscription $inscription)
    {
        $this->dispatch(
            'inscriptionToEdit',
            $inscription,
            $inscription->classe->classeOption->id
        );
    }

    public function showChangeClasseModal(Inscription $inscription)
    {
        $this->dispatch('inscriptionTochange', $inscription);
    }

    public function shwoDeleteDialog(int $id)
    {
        $this->idInscription = $id;
        $this->dispatch('delete-inscription-dialog');
    }

    public function delete()
    {
        $inscription = Inscription::find($this->idInscription);
        $student = Student::find($inscription->student_id);
        $scolayYear = (new SchoolHelper())->getCurrectScolaryYear();
        if ($inscription->payments->isEmpty()) {
            $inscription->delete();
            if ($student->scolaryYear->id == $scolayYear->id) {
                $student->delete();
            }
        } else {
            foreach ($inscription->payments as $payment) {
                $payment->delete();
            }
            $inscription->delete();
            if ($student->scolaryYear->id == $scolayYear->id) {
                $student->delete();
            }
            $inscription->delete();
        }
        $this->dispatch('inscription-deleted', ['message' => "Inscription bien rétirée !"]);
    }

    public function render()
    {
        $this->inscriptions = GetAllInscriptionHelper::getListInscriptionByClasseForCurrentYear($this->classeId, $this->keyToSearch);
        return view('livewire.application.inscription.list.list-inscription-by-classe');
    }
}
