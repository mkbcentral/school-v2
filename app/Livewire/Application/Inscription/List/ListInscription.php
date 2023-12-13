<?php

namespace App\Livewire\Application\Inscription\List;

use App\Livewire\Helpers\Inscription\GetInscriptionByDateWithPaymentStatusHelper;
use App\Livewire\Helpers\Inscription\GetInscriptionByDateHelper;
use App\Livewire\Helpers\Printing\PosPrintingHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use App\Models\Student;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListInscription extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'refreshListInscription' => '$refresh',
        'selectedClasseOption' => 'getOptionSelected',
        'deleteInscriptionListner' => 'delete'
    ];
    public  $inscriptionList = [];
    public $keySearch = '', $date_to_search, $defaultScolaryYerId, $defaultCureencyName;
    public $classeList, $classe_id = 0;
    public $classeOptionList, $classe_option_id = 0;
    public $selectedIndex = 0;
    public $idInscription;

    public function updatedClasseOptionId($val)
    {
        $this->classe_option_id = $val;
    }
    public function updatedDateToSearch($val)
    {
        $this->dispatch('changeDateSumInscription', $val);
        $this->dispatch('changeDateInscription', $val);
    }
    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }
    public  function  getCurrency($currency)
    {
        $this->defaultCureencyName = $currency;
    }

    public function getOptionSelected($index)
    {
        $this->selectedIndex = $index;
    }
    public function refreshList()
    {
        $this->dispatch('refreshInscriptionByDay');
    }
    //Valided payment inscription
    public  function valideInscriptionPayement(Inscription $inscription)
    {
        if (!$inscription->is_paied) {
            $inscription->is_paied = true;
            $inscription->update();
            //(new PosPrintingHelper())->printInscription($inscription,$this->defaultCureencyName);
        } else {
            $inscription->is_paied = false;
            $inscription->update();
        }
        $this->dispatch('refreshSumByDayInscription');
        $this->dispatch('inscription-deleted', ['message' => "Paiement inscription validée !"]);
    }

    public function mount($index)
    {
        $this->selectedIndex = $index;
        $this->date_to_search = date('Y-m-d');

        $this->classeOptionList = (new SchoolHelper())->getListClasseOption();

        $defaultScolaryYer = (new SchoolHelper())->getCurrentScolaryYear();
        $defaultCurrency = (new SchoolHelper())->getCurrentCurrency();

        $this->defaultScolaryYerId = $defaultScolaryYer->id;
        $this->defaultCureencyName = $defaultCurrency->currency;
    }

    public function edit(Student $student)
    {
        $this->dispatch('studentAndInscription', $student);
    }
    public function editInscription(Inscription $inscription)
    {
        $this->dispatch('inscriptionToEdit', $inscription, $this->selectedIndex == 0 ? $this->classe_option_id : $this->selectedIndex);
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

    public function render()
    {
        if ($this->classe_option_id == 0) {
            $this->classeList = (new SchoolHelper())->getListClasseByOption($this->selectedIndex);
        } else {
            $this->classeList = (new SchoolHelper())->getListClasseByOption($this->classe_option_id);
        }
        return view('livewire.application.inscription.list.list-inscription',
         ['inscriptions' => (new GetInscriptionByDateHelper())
         ->getDateInscriptions($this->date_to_search, $this->defaultScolaryYerId, $this->classe_id, 0, $this->defaultCureencyName)]);
    }
}
