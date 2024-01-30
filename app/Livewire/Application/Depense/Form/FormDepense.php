<?php

namespace App\Livewire\Application\Depense\Form;

use App\Livewire\Helpers\Depense\CategoryDepenseHelper;
use App\Livewire\Helpers\Depense\DepenseHelper;
use App\Livewire\Helpers\Depense\DepenseSourceHelper;
use App\Livewire\Helpers\Depense\TypeDepenseHelper;
use App\Models\CategoryDepense;
use App\Models\Currency;
use App\Models\Depense;
use App\Models\DepenseSource;
use Illuminate\Support\Collection;
use Livewire\Component;

class FormDepense extends Component
{
    public $name, $amount = 0, $currency_id, $depense_source_id, $category_depense_id, $created_at, $depense_type_id;
    public Collection $listCurrency, $listDepenseSource, $listCategoryDepense;
    public ?Depense $depense;
    public bool $isEditing;

    protected $listeners = [
        'getDepenseCreateFormData' => 'getFormCreateData',
        'getDepenseEditFormData' => 'getFormEditData'
    ];

    public function getFormCreateData(bool $isEditing = false)
    {
        $this->isEditing = $isEditing;
        $this->name = '';
        $this->amount = '';
        $this->currency_id = '';
        $this->depense_source_id = '';
    }
    public function getFormEditData(?Depense $depense, bool $isEditing = false)
    {
        $this->depense = $depense;
        $this->isEditing = $isEditing;
        $this->amount = $depense->amount;
        $this->name = $depense->name;
        $this->currency_id = $depense->currency_id;
        $this->depense_source_id = $depense->depense_source_id;
    }

    public function mount()
    {
        $this->listCurrency = Currency::all();
        $this->listDepenseSource = DepenseSourceHelper::getNotPaginate();
        $this->listCategoryDepense = CategoryDepenseHelper::getNotPaginate();
        $this->created_at = date('Y-m-d');
    }
    public function store()
    {
        $inputs = $this->validateForm();
        DepenseHelper::create($inputs);
        $this->dispatch('refreshListDepense');
        $this->dispatch('added', ['message' => "Dépense bien créée !"]);
        $this->resetForm();
    }

    public function update()
    {
        $inputs = $this->validateForm();
        DepenseHelper::update($this->depense, $inputs);
        $this->dispatch('refreshListDepense');
        $this->dispatch('updated', ['message' => "Dépense bien modifiée !"]);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->amount = '';
        $this->currency_id = '';
        $this->depense_source_id = '';
        $this->created_at = date('Y-m-d');
    }
    public function validateForm(): array
    {
        return $this->validate([
            'name' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'currency_id' => ['required', 'numeric'],
            'depense_type_id' => ['required', 'numeric'],
            'category_depense_id' => ['required', 'numeric'],
            'depense_source_id' => ['required', 'numeric'],
            'created_at' => ['required', 'date'],
        ]);
    }




    public function render()
    {
        return view('livewire.application.depense.form.form-depense', [
            'listDepenseType' => TypeDepenseHelper::getNotPaginate()
        ]);
    }
}
