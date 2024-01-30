<?php

namespace App\Livewire\Application\Depense\List;

use App\Livewire\Helpers\DateFormatHelper;
use App\Livewire\Helpers\Depense\CategoryDepenseHelper;
use App\Livewire\Helpers\Depense\DepenseHelper;
use App\Livewire\Helpers\Depense\DepenseSourceHelper;
use App\Livewire\Helpers\Depense\TypeDepenseHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Depense;
use App\Models\DepenseSource;
use Illuminate\Support\Collection;
use Livewire\Component;

class ListDepense extends Component
{
    public  array $months = [];
    public string $month, $date;
    public bool $isByDate = true;
    public ?Depense $depense;
    public bool $isEditing = false;
    public string $source = '', $category = '', $currency = '', $type_depense_id;
    public string $depenseId;
    protected $listeners = [
        'refreshListDepense' => '$refresh',
        'deleteDepenseListner' => 'delete'
    ];

    public function updatedCategory($val)
    {
        $this->category = $val;
    }
    public function updatedCurrency($val)
    {
        $this->currency = $val;
    }
    public function updatedSource($val)
    {
        $this->source = $val;
    }

    public function updatedDate($val)
    {
        $this->date = $val;
        $this->isByDate = true;
    }
    public function updatedMonth($val)
    {
        $this->month = $val;
        $this->isByDate = false;
        $this->dispatch('getMonthEmprunt', $val);
        $this->dispatch('getMonthDepense', $val);
    }

    public function new()
    {
        $this->isEditing = false;
        $this->dispatch('getDepenseCreateFormData', $this->isEditing);
    }
    public function show(Depense $depense, string $id)
    {
        $this->depense = $depense;
        $this->dispatch('getDepenseData', $depense);
    }

    public function edit(Depense $depense, string $id)
    {
        $this->isEditing = true;
        $this->dispatch('getDepenseEditFormData', $depense, $this->isEditing);
    }


    public function showDeleteDialog(string $id): void
    {
        $this->depenseId = $id;
        $this->dispatch('delete-depense-dialog');
    }

    public function delete()
    {
        try {
            $depense = DepenseHelper::show($this->depenseId);
            DepenseHelper::delete($depense);
            $this->dispatch('depense-deleted', ['message' => "Action bien réalisée !"]);
        } catch (\Exception $ex) {
            $this->dispatch('error',  $ex->getMessage());
        }
    }

    public function mount()
    {
        $this->month = date('m');
        $this->date = date('Y-m-d');
        $this->months = (new DateFormatHelper())->getMonthsForScolaryYear();
        $this->type_depense_id = TypeDepenseHelper::getSchoolType()->id;
    }

    public function render()
    {
        $this->dispatch('getMonthDepense', $this->month);
        return view('livewire.application.depense.list.list-depense', [
            'listTypeDepense' => TypeDepenseHelper::getNotPaginate(),
            'listDepense' => $this->isByDate == true
                ? DepenseHelper::getByDate($this->date, $this->currency, $this->source, $this->category, $this->type_depense_id)
                : DepenseHelper::getByMonth($this->month, $this->currency, $this->source, $this->category, $this->type_depense_id),
            'currencyList' => SchoolHelper::getCurrencyList(),
            'listDepenseSource' => DepenseSourceHelper::getNotPaginate(),
            'listCategoryDepense' => CategoryDepenseHelper::getNotPaginate(),

        ]);
    }
}
