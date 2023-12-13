<?php

namespace App\Livewire\Helpers\Depense;

use App\Models\CategoryDepense;
use Illuminate\Support\Collection;

class CategoryDepenseHelser
{
    public static function get():Collection{
        return CategoryDepense::all();
    }
    public static function create(array $inputs):CategoryDepense
    {
        $inputs['school_id']=auth()->user()->school->id;
        return CategoryDepense::create($inputs);
    }
    public static function show(string $id):CategoryDepense
    {
        return CategoryDepense::find($id);
    }
    public static function update(CategoryDepense $categoryDepense, array $inputs)
    {
        $categoryDepense->update($inputs);
    }
    public static function delete(CategoryDepense $categoryDepense)
    {
        $categoryDepense->delete();
    }
}
