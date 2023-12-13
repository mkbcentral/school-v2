<?php

namespace App\View\Components\Widget;

use App\Livewire\Helpers\SchoolHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ListClasseSelectWidget extends Component
{
    
    public ?Collection $classeList; 
    /**
     * Create a new component instance.
     */
    public function __construct(public int $option=0)
    {
        $this->classeList=(new SchoolHelper())->getListClasseByOption($option);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widget.list-classe-select-widget');
    }
}
