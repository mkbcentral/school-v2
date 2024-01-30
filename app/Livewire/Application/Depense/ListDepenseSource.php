<?php

namespace App\Livewire\Application\Depense;

use App\Livewire\Helpers\Depense\DepenseSourceHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\DepenseSource;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListDepenseSource extends Component
{
    use WithPagination;
    public $name, $month_name;
    public DepenseSource $depenseSource;
    public bool $isEditing = false;
    public function store()
    {
        $inputs = $this->validate([
            'name' => ['required', 'string'],
            'month_name' => ['nullable', 'string'],
        ]);
        DepenseSourceHelper::create($inputs);
        $this->dispatch('added', ['message' => "source dépense bien ajoutée !"]);
        $this->name = '';
    }
    public function edit(DepenseSource $depenseSource, string $id)
    {
        $this->depenseSource = $depenseSource;
        $this->name = $depenseSource->name;
        $this->month_name = $depenseSource->month_name;
        $this->isEditing = true;
    }

    public function update()
    {
        $inputs = $this->validate([
            'name' => ['required', 'string'],
            'month_name' => ['nullable', 'string'],
        ]);
        DepenseSourceHelper::update($this->depenseSource, $inputs);
        $this->dispatch('updated', ['message' => "source dépense bien modifiée !"]);
        $this->name = '';
        $this->isEditing = false;
    }
    public function delete(string $id)
    {
        $depenseSource = DepenseSourceHelper::show($id);
        DepenseSourceHelper::delete($depenseSource);
        $this->dispatch('error', ['message' => "Source bien rétirée !"]);
    }
    public function render()
    {
        return view('livewire.application.depense.list-depense-source', [
            'listDepenseSource' => DepenseSourceHelper::get()
        ]);
    }
}
