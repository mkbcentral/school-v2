<?php

namespace App\Livewire\Application\Depense;

use App\Livewire\Helpers\Depense\TypeDepenseHelper;
use App\Models\DepenseType;
use Livewire\Component;
use Livewire\WithPagination;

class ListDepenseType extends Component
{
    use WithPagination;
    public $name;
    public DepenseType $depenseType;
    public bool $isEditing = false;
    public function store()
    {
        $inputs = $this->validate(['name' => ['required', 'string']]);
        TypeDepenseHelper::create($inputs);
        $this->dispatch('added', ['message' => "Catégorie dépense bien ajoutée !"]);
        $this->name = '';
    }
    public function edit(DepenseType $depenseType, string $id)
    {
        $this->depenseType = $depenseType;
        $this->name = $depenseType->name;
        $this->isEditing = true;
    }

    public function update()
    {
        $inputs = $this->validate(['name' => ['required', 'string']]);
        TypeDepenseHelper::update($this->depenseType, $inputs);
        $this->dispatch('updated', ['message' => "Catégorie dépense bien modifiée !"]);
        $this->name = '';
        $this->isEditing = false;
    }
    public function delete(string $id)
    {
        $depenseType = TypeDepenseHelper::show($id);
        TypeDepenseHelper::delete($depenseType);
        $this->dispatch('error', ['message' => "Catégorie bien rétirée !"]);
    }
    public function render()
    {
        return view('livewire.application.depense.list-depense-type', [
            'listDepenseType' => TypeDepenseHelper::get()
        ]);
    }
}
