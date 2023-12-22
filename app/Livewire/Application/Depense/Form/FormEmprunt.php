<?php

namespace App\Livewire\Application\Depense\Form;

use App\Livewire\Helpers\Depense\EmpruntHelper;
use App\Models\Currency;
use App\Models\Emprunt;
use Illuminate\Support\Collection;
use Livewire\Component;

class FormEmprunt extends Component
{
    protected $listeners = [
        'empruntData' => 'getEmprunt'
    ];

    public $amount, $description, $currency_id, $created_at;
    public ?Emprunt $empruntToEdit = null;
    public ?Collection $listCurrency;

    public function mount()
    {
        $this->listCurrency = Currency::all();
    }

    public function getEmprunt(Emprunt $emprunt)
    {
        $this->empruntToEdit = $emprunt;

        $this->amount = $emprunt->amount;
        $this->description = $emprunt->description;
        $this->created_at = $emprunt->created_at->format('Y-m-d');
        $this->currency_id = $emprunt->currency_id;
    }

    public function store()
    {
        $inputs = $this->validate(
            [
                'amount' => ['required', 'numeric'],
                'description' => ['required', 'string'],
                'currency_id' => ['required', 'numeric']
            ]
        );
        EmpruntHelper::create($inputs);
        $this->dispatch('added', ['message' => "Emprunt bien ajouté !"]);
        $this->amount = '';
        $this->description = '';
        $this->dispatch('refreshEmprent');
    }

    public function update()
    {
        $inputs = $this->validate([
            'amount' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'currency_id' => ['required', 'numeric'],
            'created_at' => ['date', 'required']
        ]);
        EmpruntHelper::update($this->empruntToEdit, $inputs);
        $this->dispatch('updated', ['message' => "Emprunt bien modifié !"]);
        $this->amount = '';
        $this->description = '';
        $this->currency_id = '';
        $this->empruntToEdit = null;
        $this->dispatch('refreshEmprent');
    }

    public function handlerSubmit()
    {
        if ($this->empruntToEdit == null) {
            $this->store();
        } else {
            $this->update();
        }
    }

    public function render()
    {
        return view('livewire.application.depense.form.form-emprunt');
    }
}
