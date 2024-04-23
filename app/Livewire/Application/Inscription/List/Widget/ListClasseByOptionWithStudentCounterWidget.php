<?php

namespace App\Livewire\Application\Inscription\List\Widget;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\ClasseOption;
use Livewire\Component;

class ListClasseByOptionWithStudentCounterWidget extends Component
{
    public $classeList, $classe_id = 0, $classe_option_id = 0;

    public function mount()
    {
        $defaultClasseOption = ClasseOption::first();
        $this->classe_option_id = $defaultClasseOption->id;
    }
    public function render()
    {
        $this->classeList = (new SchoolHelper())->getListClasseByOption($this->classe_option_id);
        return view('livewire.application.inscription.list.widget.list-classe-by-option-with-student-counter-widget', [
            'classeOptionList' => (new SchoolHelper())->getListClasseOption()
        ]);
    }
}
