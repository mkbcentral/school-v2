<?php

namespace App\Livewire\Application\Depense;

use App\Livewire\Helpers\Depense\CategoryDepenseHelper;
use App\Models\CategoryDepense;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategoryDepense extends Component
{
    use WithPagination;
    public $name;
    public CategoryDepense $categoryDepense;
    public bool $isEditing = false;
    public function store()
    {
        $inputs = $this->validate(['name' => ['required', 'string']]);
        CategoryDepenseHelper::create($inputs);
        $this->dispatch('added', ['message' => "Catégorie dépense bien ajoutée !"]);
        $this->name = '';
    }
    public function edit(CategoryDepense $categoryDepense, string $id)
    {
        $this->categoryDepense = $categoryDepense;
        $this->name = $categoryDepense->name;
        $this->isEditing = true;
    }

    public function update()
    {
        $inputs = $this->validate(['name' => ['required', 'string']]);
        CategoryDepenseHelper::update($this->categoryDepense, $inputs);
        $this->dispatch('updated', ['message' => "Catégorie dépense bien modifiée !"]);
        $this->name = '';
        $this->isEditing = false;
    }
    public function delete(string $id)
    {
        $categoryDepense = CategoryDepenseHelper::show($id);
        CategoryDepenseHelper::delete($categoryDepense);
        $this->dispatch('error', ['message' => "Catégorie bien rétirée !"]);
    }
    public function render()
    {
        return view('livewire.application.depense.list-category-depense', [
            'listCategoryDepense' => CategoryDepenseHelper::get()
        ]);
    }
}
