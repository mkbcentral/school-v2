<?php

namespace App\Livewire\Application\Inscription\Forms;

use App\Livewire\Helpers\Cost\CostInscriptionHelper;
use App\Livewire\Helpers\Inscription\CreateNewInscriptionHelper;
use App\Livewire\Helpers\Responsable\CreateNewResponsableHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Livewire\Helpers\Student\CreateNewStundentHelper;
use App\Http\Requests\NewStudentRequest;
use App\Models\Student;
use App\Models\StudentResponsable;
use Livewire\Component;
class CreateNewInscriptionForm extends Component
{
    protected $listeners = [
        'selectedClasseOption' => 'getOptionSelected',
        'selectRresposableId'=>'getIdResponsable'
    ];
    public $costInscriptionList = [], $genderList = [];
    public $selectedOption = 0,$defaultScolaryYear;
    public $name, $date_of_birth, $gender, $classe_id, $cost_inscription_id,$place_of_birth;
    public ?StudentResponsable $responsable;
    public  function getOptionSelected($index): void
    {
        $this->selectedOption=$index;
    }
    public function getIdResponsable(StudentResponsable $responsable):void{
        $this->responsable=$responsable;
    }
    public function store(): void
    {
        $request = new NewStudentRequest();
        $data = $this->validate($request->rules());
        $studentChek = Student::where('name', $data['name'])->first();
        if ($studentChek) {
            $this->dispatch('deleted', ['message' => "Désolé cet élève existe déjà !"]);
        } else {
            $data['scolary_year_id']=$this->defaultScolaryYear->id;
            $data['school_id']=auth()->user()->school->id;
            $data['student_responsable_id']=$this->responsable->id;
            $student= CreateNewStundentHelper::create($data);
            (new CreateNewInscriptionHelper())
                ->create(
                    $this->defaultScolaryYear->id,
                    $data['cost_inscription_id'],
                    $student->id,
                    $data['classe_id'],
                    $this->selectedOption
                );
            $this->dispatch('added', ['message' => "Action bien réalisée !"]);
            $this->dispatch('refreshListInscription');
            $this->dispatch('refreshListResponsible');
        }
    }
    public function mount(int $index): void
    {
        $this->selectedOption=$index;
        $this->costInscriptionList = (new CostInscriptionHelper())->getListCostInscription();;
        $this->genderList = (new SchoolHelper())->getListOfGender();
        $this->defaultScolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
    }
    public function render()
    {
        $classeList = (new SchoolHelper())->getListClasseByOption($this->selectedOption);
        return view('livewire.application.inscription.forms.create-new-inscription-form', ['classeList' => $classeList]);
    }
}
