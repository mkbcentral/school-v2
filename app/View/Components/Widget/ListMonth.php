<?php

namespace App\View\Components\Widget;

use App\Livewire\Helpers\DateFormatHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListMonth extends Component
{
    public array $months=[];
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->months=(new DateFormatHelper())->getMonthsForYear();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widget.list-month');
    }
}
