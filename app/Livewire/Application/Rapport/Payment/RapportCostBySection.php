<?php

namespace App\Livewire\Application\Rapport\Payment;

use App\Models\Section;
use Livewire\Component;

class RapportCostBySection extends Component
{
    public function render()
    {
        return view('livewire.application.rapport.payment.rapport-cost-by-section', [
            'sections' => Section::all(),
        ]);
    }
}
