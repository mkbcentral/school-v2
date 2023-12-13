<?php

namespace App\View\Components\Widget;

use App\Livewire\Helpers\Cost\CostGeneralHelper;
use App\Livewire\Helpers\SchoolHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ListCostGeneralSelectWidget extends Component
{
     public Collection $listGeneralCost;
    /**
     * Create a new component instance.
     */
    public function __construct(public int $type=0)
    {
        $this->listGeneralCost=(new CostGeneralHelper())
        ->getListCostGeneral($type, (new SchoolHelper())->getCurrentScolaryYear()->id);;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widget.list-cost-general-select-widget');
    }
}
