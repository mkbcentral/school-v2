<?php

namespace App\Livewire\Application\School;

use App\Models\ScolaryYear;
use Livewire\Component;

class ScolaryYearWidget extends Component
{
    public $defaulScolaryYear;
    public $scolary_year_id;

    public function updatedScolaryYearId($val){
        $this->dispatch('scolaryYearFresh', $val);
    }

    public function mount(){
        
        if (auth()->user() != null) {
            $this->defaulScolaryYear=ScolaryYear::where('school_id',auth()->user()->school->id)
            ?->where('active',true)?->first();
        }
    }

    public function render()
    {
        $listScolaryYear=ScolaryYear::where('school_id',auth()->user()->school->id)
                        ?->orderBy('active','ASC')?->get();
        return view('livewire.application.school.scolary-year-widget',['listScolaryYear'=>$listScolaryYear]);
    }
}
