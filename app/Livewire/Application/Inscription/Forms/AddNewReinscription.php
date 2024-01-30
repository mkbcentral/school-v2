<?php

namespace App\Livewire\Application\Inscription\Forms;

use App\Livewire\Helpers\Cost\CostInscriptionHelper;
use App\Livewire\Helpers\Cost\TypeCostHelper;
use App\Livewire\Helpers\DateFormatHelper;
use App\Livewire\Helpers\Inscription\CreateNewInscriptionHelper;
use App\Livewire\Helpers\Inscription\ExistingInscriptionCheckerHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Student;
use App\Models\StudentResponsable;
use Livewire\Component;

class AddNewReinscription extends Component
{
    protected $listeners = ['studentReinscription' => 'getStudent'];
    public  $student = null;
    public $classe_id, $cost_inscription_id, $classe_option_id;
    public $costInscriptionList = [], $listClasseOption = [];
    public $defaultScolaryYear, $months = [], $student_responsable_id = 0;
    public  $listStudentResponsable = [];
    public array $typeCostSelected = [];
    public $listOldCostType = [];
    public $listTypeCost = [];

    protected $rules = [
        'classe_option_id' => ['required', 'numeric'],
        'cost_inscription_id' => ['required', 'numeric'],
        'classe_id' => ['required', 'numeric'],
    ];

    /**
     * Mise à jour automatique du système de validation
     * @param $propertyName
     * @return void
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName, [
            'classe_option_id' => ['required', 'numeric'],
            'cost_inscription_id' => ['required', 'numeric'],
            'classe_id' => ['required', 'numeric'],
        ]);
    }

    /**
     * updated classe option id
     * @param $val
     * @return void
     */
    public function updatedClasseOptionId($val): void
    {
        $this->classe_option_id = $val;
    }

    /**
     * Get student id selected
     * @param Student $student
     * @return void
     */
    public function getStudent(Student $student): void
    {
        $this->student = null;
        $this->student = $student;
    }

    /**
     * Save new inscription
     * @return void
     */
    public function store(): void
    {
        $this->validate();
        $inscription = ExistingInscriptionCheckerHelper::checkIfInscriptionExist($this->student->id, $this->classe_id, $this->defaultScolaryYear->id);
        if ($inscription) {
            $this->dispatch('error', ['message' => "Cet élève est déjà inscrit !"]);
        } else {
            (new CreateNewInscriptionHelper())
                ->create(
                    $this->defaultScolaryYear->id,
                    $this->cost_inscription_id,
                    $this->student->id,
                    $this->classe_id,
                    $this->classe_option_id,
                    true
                );
            $this->student->student_responsable_id = $this->student_responsable_id;
            $inscription - $this->student->update();
            $this->dispatch('refreshListInscription');
            $this->dispatch('added', ['message' => "Reinscription bien sauvegargée !"]);
        }
    }
    /**
     * Mounted component
     * @return void
     */
    public function mount(): void
    {
        $this->costInscriptionList = (new CostInscriptionHelper())->getListCostInscription();
        $this->listClasseOption = (new SchoolHelper())->getListClasseOption();
        $this->defaultScolaryYear = (new SchoolHelper())->getCurrentScolaryYear();
        $this->listOldCostType = (new TypeCostHelper())->getListDisableOldTypeCost();
        $this->months = (new DateFormatHelper())->getMonthsForScolaryYear();
    }

    public function render()
    {
        $this->listStudentResponsable = StudentResponsable::orderBy('created_at', 'DESC')->get();
        $this->listTypeCost = (new TypeCostHelper())->getListDisableTypeCostWithArrayId($this->typeCostSelected);
        $classeList = (new SchoolHelper())->getListClasseByOption($this->classe_option_id);
        return view('livewire.application.inscription.forms.add-new-reinscription', ['classeList' => $classeList]);
    }
}
