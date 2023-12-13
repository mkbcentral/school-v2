<?php

namespace App\View\Components\Widget;

use App\Livewire\Helpers\Cost\TypeCostHelper;
use App\Livewire\Helpers\SchoolHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ListTypeCostSelectWidget extends Component
{
    public Collection $listTypeCost;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->listTypeCost = (new TypeCostHelper())
            ->getListTypeCost((new SchoolHelper())->getCurrentScolaryYear()->id);
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widget.list-type-cost-select-widget');
    }
}
