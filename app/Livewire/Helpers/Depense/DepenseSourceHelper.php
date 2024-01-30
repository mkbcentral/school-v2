<?php

namespace App\Livewire\Helpers\Depense;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\DepenseSource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DepenseSourceHelper
{
    public static function get(): LengthAwarePaginator
    {
        return DepenseSource::orderBy('name', 'ASC')
            ->where('school_id', Auth::user()->school->id)
            ->where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->paginate(5);
    }
    public static function getNotPaginate(): Collection
    {
        return DepenseSource::orderBy('name', 'ASC')
            ->where('school_id', Auth::user()->school->id)
            ->where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->get();
    }
    public static function create(array $inputs): DepenseSource
    {
        $inputs['school_id'] = auth()->user()->school->id;
        $inputs['scolary_year_id'] = (new SchoolHelper())->getCurrectScolaryYear()->id;
        return DepenseSource::create($inputs);
    }
    public static function show(string $id): DepenseSource
    {
        return DepenseSource::find($id);
    }
    public static function update(DepenseSource $depenseSource, array $inputs)
    {
        $inputs['school_id'] = auth()->user()->school->id;
        $inputs['scolary_year_id'] = (new SchoolHelper())->getCurrectScolaryYear()->id;
        $depenseSource->update($inputs);
    }
    public static function delete(DepenseSource $depenseSource)
    {
        $depenseSource->delete();
    }
}
