<?php

namespace App\Livewire\Application\Inscription\List;

use App\Livewire\Helpers\Inscription\GetAllInscriptionHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use App\Models\Student;
use Livewire\Component;

class ListAllInscription extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
    ];

    public $keyToSearch = '', $date_to_search, $defaultScolaryYerId;
    public $classeList, $classe_id = 0;
    public $classeOptionList, $classe_option_id = 0;

    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }
    public function edit(Student $student)
    {
        $this->dispatch('studentAndInscription', $student);
    }
    public function editInscription(Inscription $inscription)
    {
        $this->dispatch('inscriptionToEdit', $inscription, $this->classe_option_id);
    }

    public function delete($id)
    {
        $inscription = Inscription::find($id);
        $student = Student::find($inscription->student_id);
        $scolayYear = (new SchoolHelper())->getCurrentScolaryYear();

        if ($inscription->payments->isEmpty()) {
            $inscription->delete();
            if ($student->scolaryYear->id == $scolayYear->id) {
                $student->delete();
            }
            $this->dispatch('added', ['message' => "Famille bien rétirée !"]);
        } else {
            $this->dispatch('error', ['message' => "Impossible, Famille déjà remplie"]);
        }
    }

    public function mount()
    {
        $defaultScolaryYer = (new SchoolHelper())->getCurrentScolaryYear();
        $this->defaultScolaryYerId = $defaultScolaryYer->id;
        $this->classeOptionList = (new SchoolHelper())->getListClasseOption();
    }

    public function render()
    {
        $this->classeList = (new SchoolHelper())->getListClasseByOption($this->classe_option_id);
        return view('livewire.application.inscription.list.list-all-inscription', [
            'inscriptions' => GetAllInscriptionHelper::getAllInscription(
                $this->defaultScolaryYerId,
                $this->classe_id,
                $this->keyToSearch
            )
        ]);
    }
}
