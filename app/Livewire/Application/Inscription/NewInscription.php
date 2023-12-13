<?php

namespace App\Livewire\Application\Inscription;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\ClasseOption;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class NewInscription extends Component
{
    use AuthorizesRequests;
    public $selectedIndex = 0;
    public $costs = [];
    public  $optionList;

    public function mount()
    {
        $defualtOption = ClasseOption::first();
        $this->selectedIndex = $defualtOption->id;
        $this->optionList = (new SchoolHelper())->getListClasseOption();
    }
    public function changeIndex(ClasseOption $option)
    {
        $this->selectedIndex = $option->id;
        $this->dispatch('selectedClasseOption', $this->selectedIndex);;
    }

    public function render()
    {
        return view('livewire.application.inscription.new-inscription');
    }
}
