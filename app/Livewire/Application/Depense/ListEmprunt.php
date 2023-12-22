<?php

namespace App\Livewire\Application\Depense;

use App\Livewire\Helpers\DateFormatHelper;
use App\Livewire\Helpers\Depense\EmpruntHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Currency;
use App\Models\Emprunt;
use Illuminate\Support\Collection;
use Livewire\Component;

class ListEmprunt extends Component
{
    protected $listeners = [
        'refreshEmprent' => '$refresh',
        'deleteEmpruntListner' => 'delete'
    ];
    public  array $months = [];
    public string $month;
    public $totalByCurrency;
    public ?Emprunt $empruntToDelete;

    public function updatedMonth($val)
    {
        $this->month = $val;
    }
    public function edit(Emprunt $emprunt)
    {
        $this->dispatch('empruntData', $emprunt);
    }

    public function showDeleteDialog(Emprunt $emprunt)
    {
        $this->empruntToDelete = $emprunt;
        $this->dispatch('delete-emprunt-dialog');
    }

    public function delete()
    {
        $emprunt = EmpruntHelper::show($this->empruntToDelete->id);
        EmpruntHelper::delete($emprunt);
        $this->dispatch('emprunt-deleted', ['message' => "Emprunt bien rétiré !"]);
    }

    public function mount()
    {
        $this->month = date('m');
        $this->months = (new DateFormatHelper())->getMonthsForScolaryYear();
    }
    public function render()
    {
        return view(
            'livewire.application.depense.list-emprunt',
            [
                'listEmprunt' => EmpruntHelper::get($this->month),
                'totalByCurrency' => EmpruntHelper::getAmountEmpruntGroupingByCurrency($this->month)
            ]
        );
    }
}
