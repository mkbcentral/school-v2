<?php

namespace App\Livewire\Application\Rapport\Payment;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\Section;
use App\Models\TypeOtherCost;
use Illuminate\Support\Collection;
use Livewire\Component;

class RapportCostEtat extends Component
{
    public $idSelected = 13;
    public $valureForSeach = "Frais d'état";
    public Collection $costEtatList;

    public function updatedIdSelected($val)
    {
        $this->idSelected = $val;
    }

    public function mount()
    {
        $this->costEtatList = TypeOtherCost::where('name', 'like', '%' . $this->valureForSeach . '%')
            ->where('scolary_year_id', (new SchoolHelper())->getCurrentScolaryYear()->id)
            ->get();
    }
    public function render()
    {
        return view('livewire.application.rapport.payment.rapport-cost-etat', [
            'sections' => Section::all()
        ]);
    }
}
