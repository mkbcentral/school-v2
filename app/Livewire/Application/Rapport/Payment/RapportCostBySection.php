<?php

namespace App\Livewire\Application\Rapport\Payment;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\ClasseOption;
use App\Models\Section;
use Livewire\Component;

class RapportCostBySection extends Component
{
    public $month;
    public $optionId;
    public $classOptions = [];
    public ?Section  $sectionSelected = null;

    public function getSection(Section $section)
    {
        $this->sectionSelected = $section;
        $this->classOptions = ClasseOption::where("section_id", $section->id)->get();
    }


    public function render()
    {
        return view('livewire.application.rapport.payment.rapport-cost-by-section', [
            'sections' => Section::all(),
            'classOptions' => (new SchoolHelper())->getListClasseOption(),
        ]);
    }
}
