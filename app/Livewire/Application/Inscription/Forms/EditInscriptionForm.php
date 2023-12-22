<?php

namespace App\Livewire\Application\Inscription\Forms;

use App\Livewire\Helpers\Responsable\CreateNewResponsableHelper;
use App\Http\Requests\EditStudentRequest;
use App\Models\Classe;
use App\Models\CostInscription;
use App\Models\Gender;
use App\Models\Inscription;
use App\Models\Student;
use App\Models\StudentResponsable;
use Livewire\Component;

class EditInscriptionForm extends Component
{
    protected $listeners = ['studentAndInscription' => 'getStudentAndInscription'];
    public  $student = null,$age='';
    public $costInscriptionList = [], $genderList = [],$listResonsable=[];
    public $name, $date_of_birth, $place_of_birth, $gender,$student_responsable_id;

    public function getStudentAndInscription(Student $student)
    {
        $this->student = $student;
    }

    public function update()
    {
        $request = new EditStudentRequest();
        $data = $this->validate($request->rules());
        $this->student->update($data);
        $this->dispatch('updated', ['message' => "Info bien mise jour!"]);
        $this->dispatch('refreshListInscription');
        $this->dispatch('refreshSudentList');
        $this->student=null;
    }


    public function resetFrom(){
        $this->student=null;
    }

    public function mount()
    {
        $this->costInscriptionList = CostInscription::where('school_id', auth()->user()->school->id)
            ->orderBy('created_at', 'DESC')->get();
        $this->genderList = Gender::all();
        $this->listResonsable=StudentResponsable::orderBy('created_at', 'DESC')->get();

    }

    public function render()
    {

        $this->name = $this->student?->name;
        $this->date_of_birth = $this->student?->date_of_birth->format('Y-m-d');

        $this->gender = $this->student?->gender;
        $this->place_of_birth = $this->student?->place_of_birth;
        $this->student_responsable_id = $this->student?->student_responsable_id;
        $this->age=$this->student?->getAge($this->student?->date_of_birth);

        return view('livewire.application.inscription.forms.edit-inscription-form');
    }
}
