<?php

namespace App\View\Components\Widget;

use App\Livewire\Helpers\SchoolHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ListClasseOptionWidget extends Component
{
    public ?Collection $lisClasseOption;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->lisClasseOption=(new SchoolHelper())->getListClasseOption();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widget.list-classe-option-widget');
    }
}
