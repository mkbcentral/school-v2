<?php

namespace App\Livewire\Application\Depense;

use App\Livewire\Helpers\DateFormatHelper;
use App\Livewire\Helpers\Depense\RetourCaisseHelper;
use App\Models\Currency;
use App\Models\Depense;
use App\Models\RetourCaisse;
use Illuminate\Support\Collection;
use Livewire\Component;

class ListRetourCaisse extends Component
{
    protected $listeners = [
        'getDepenseData' => 'getDepense',
    ];
    public $amount, $name, $currency_id, $created_at,$depense_id;
    public RetourCaisse $retourCaisse;
    public Depense $depense;
    public bool $isEditing = false;
    public Collection $listCurrency;
    public  array $months = [];
    public string $month;
    public $totalByCurrency;

    public function updatedMonth($val)
    {
        $this->month = $val;
    }

    public function getDepense(Depense $depense){
        $this->depense  = $depense;
    }

    public function store()
    {
        $inputs = $this->validate(
            [
                'amount' => ['required', 'numeric'],
                'name' => ['required', 'string'],
                'currency_id' => ['required', 'numeric'],
            ]
        );
        $inputs['depense_id'] = $this->depense->id;
        RetourCaisseHelper::create($inputs);
        $this->dispatch('added', ['message' => "Emprunt bien ajouté !"]);
        $this->amount = '';
        $this->name = '';
        $this->depense_id = '';
    }
    public function edit(RetourCaisse $retourCaisse, string $id)
    {
        $this->retourCaisse = $retourCaisse;
        $this->amount = $retourCaisse->amount;
        $this->name = $retourCaisse->name;
        $this->created_at = $retourCaisse->created_at->format('Y-m-d');
        $this->currency_id = $retourCaisse->currency_id;
        $this->depense_id = $retourCaisse->depense_id;
        $this->isEditing = true;
    }

    public function update()
    {
        $inputs = $this->validate([
            'amount' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'currency_id' => ['required', 'numeric'],
            'created_at' => ['date', 'required']
        ]);
        $inputs['depense_id'] = $this->depense->id;
        RetourCaisseHelper::update($this->retourCaisse, $inputs);
        $this->dispatch('updated', ['message' => "Emprunt bien modifié !"]);
        $this->amount = '';
        $this->name = '';
        $this->currency_id = '';
        $this->isEditing = false;
    }
    public function delete(string $id)
    {
        $retourCaisse = RetourCaisse::show($id);
        RetourCaisseHelper::delete($retourCaisse);
        $this->dispatch('error', ['message' => "Emprunt bien rétiré !"]);
    }

    public function mount()
    {
        $this->listCurrency = Currency::all();
        $this->month = date('m');
        $this->months = (new DateFormatHelper())->getMonthsForScolaryYear();

    }
    public function render()
    {
        return view('livewire.application.depense.list-retour-caisse',[
            'listEmprunt'=>RetourCaisseHelper::get($this->month)
        ]);
    }
}
