<?php

namespace App\Livewire\Application\Tarification\Form;

use App\Livewire\Helpers\Cost\CostGeneralHelper;
use App\Livewire\Helpers\Cost\CrudCostGeneralHelper;
use App\Livewire\Helpers\Cost\TypeCostHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\CostGeneral;
use Illuminate\Support\Collection;
use Livewire\Component;

class FormTarification extends Component
{
    protected $listeners = [
        'getTarifCreateFormData' => 'getFormCreateData',
        'getTarifEditFormData' => 'getFormEditData'
    ];
    public $name, $amount, $type_other_cost_id, $currency_id, $classe_option_id = 0;
    public bool $isEditing = false;
    public Collection $listCurrency, $listOtherTYpeCost, $listClasseOption;
    public $idDefaultIdScolaryYear;
    public ?CostGeneral $costGeneral;

    public function getFormCreateData(bool $isEditing = false)
    {
        $this->isEditing = $isEditing;
        $this->name = '';
        $this->amount = '';
        $this->currency_id = '';
        $this->type_other_cost_id = '';
        $this->classe_option_id = '';
    }
    public function getFormEditData(?CostGeneral $costGeneral, bool $isEditing = false)
    {
        $this->costGeneral = $costGeneral;
        $this->isEditing = $isEditing;
        $this->amount = $costGeneral->amount;
        $this->name = $costGeneral->name;
        $this->currency_id = $costGeneral->currency_id;
        $this->type_other_cost_id = $costGeneral->type_other_cost_id;
        $this->classe_option_id = $costGeneral->classe_option_id;
    }


    public function new()
    {
        $this->isEditing = false;
        $this->dispatch('getTarifCreateFormData', $this->isEditing);
    }

    public function store()
    {
        $inputs = $this->validateForm();
        if ($this->classe_option_id==null) {
            $inputs['classe_option_id'] = NULL;
        }
        CrudCostGeneralHelper::create($inputs);
        $this->dispatch('refreshListTarification');
        $this->dispatch('added', ['message' => "Tarif bien créé !"]);
    }

    public function update()
    {

        $inputs = $this->validateForm();

        CrudCostGeneralHelper::update($this->costGeneral, $inputs);
        $this->dispatch('refreshListTarification');
        $this->dispatch('updated', ['message' => "Tarif bien modifié !"]);

    }

    public function validateForm(): array
    {
        return $this->validate(
            [
                'name' => ['required', 'string'],
                'amount' => ['required', 'numeric'],
                'type_other_cost_id' => ['required', 'numeric'],
                'currency_id' => ['required', 'numeric'],
                'classe_option_id' => ['nullable', 'numeric']
            ]
        );
    }

    public function mount()
    {
        $this->classe_option_id=0;
        $scolaryYear = (new SchoolHelper())->getCurrentScolaryYear();
        $this->idDefaultIdScolaryYear = $scolaryYear->id;
        $this->listCurrency = (new SchoolHelper())->getCurrencyList();
        $this->listOtherTYpeCost = (new TypeCostHelper())->getListTypeCost($this->idDefaultIdScolaryYear);
        $this->listClasseOption = (new SchoolHelper())->getListClasseOption();
    }
    public function render()
    {
        return view('livewire.application.tarification.form.form-tarification');
    }
}
