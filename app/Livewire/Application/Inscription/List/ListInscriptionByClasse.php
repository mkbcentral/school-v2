<?php

namespace App\Livewire\Application\Inscription\List;

use App\Livewire\Helpers\Inscription\GetAllInscriptionHelper;
use App\Models\Classe;
use Livewire\Component;

class ListInscriptionByClasse extends Component
{
    public $keyToSearch = '';
    public $classeId;
    public $inscriptions;
    public $classeData;
    public function mount($classe){
       $this->classeId=$classe;
       $this->classeData=Classe::find($classe);
    }
    public function render()
    {
        $this->inscriptions=GetAllInscriptionHelper::getListInscriptionByClasseForCurrentYear($this->classeId,$this->keyToSearch);
        return view('livewire.application.inscription.list.list-inscription-by-classe');
    }
}
