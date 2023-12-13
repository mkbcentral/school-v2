<?php

namespace App\Livewire\Application\Inscription\Forms;

use App\Livewire\Helpers\Responsable\CreateNewResponsableHelper;
use App\Http\Requests\NewStudentResponsableRequest;
use Livewire\Component;

class AddNewFamilly extends Component
{
    public $name_responsable,$phone,$other_phone,$email;

    public function store(): void
    {
        $request = new NewStudentResponsableRequest();
        $data = $this->validate($request->rules());
        $data['school_id']=auth()->user()->school->id;
        CreateNewResponsableHelper::create($data);
        $this->dispatch('added', ['message' => "Famille bien créée !"]);
        $this->dispatch('refreshListResponsible');
        $this->dispatch('refreshListInscription');
    }
    public function render()
    {
        return view('livewire.application.inscription.forms.add-new-familly');
    }
}
