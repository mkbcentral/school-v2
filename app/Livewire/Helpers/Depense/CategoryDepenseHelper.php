<?php

namespace App\Livewire\Helpers\Depense;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\CategoryDepense;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CategoryDepenseHelper
{
    public static function get(): LengthAwarePaginator
    {
        return CategoryDepense::orderBy('name', 'ASC')
            ->where('school_id', Auth::user()->school->id)
            ->where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->paginate(5);
    }
    public static function getNotPaginate(): Collection
    {
        return CategoryDepense::orderBy('name', 'ASC')
            ->where('school_id', Auth::user()->school->id)
            ->where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->get();
    }
    public static function create(array $inputs): CategoryDepense
    {
        $inputs['school_id'] = auth()->user()->school->id;
        $inputs['scolary_year_id'] = (new SchoolHelper())->getCurrectScolaryYear()->id;
        return CategoryDepense::create($inputs);
    }
    public static function show(string $id): CategoryDepense
    {
        return CategoryDepense::find($id);
    }
    public static function update(CategoryDepense $categoryDepense, array $inputs)
    {
        $inputs['school_id'] = auth()->user()->school->id;
        $inputs['scolary_year_id'] = (new SchoolHelper())->getCurrectScolaryYear()->id;
        $categoryDepense->update($inputs);
    }
    public static function delete(CategoryDepense $categoryDepense)
    {
        $categoryDepense->delete();
    }
}
