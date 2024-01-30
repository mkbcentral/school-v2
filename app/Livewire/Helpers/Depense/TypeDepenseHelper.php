<?php

namespace App\Livewire\Helpers\Depense;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\DepenseType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class TypeDepenseHelper
{
    public static function get(): LengthAwarePaginator
    {
        return DepenseType::orderBy('name', 'ASC')
            ->where('school_id', Auth::user()->school->id)
            ->where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->paginate(5);
    }

    public static function getNotPaginate(): Collection
    {
        return DepenseType::orderBy('name', 'ASC')
            ->where('school_id', Auth::user()->school->id)
            ->where('scolary_year_id', (new SchoolHelper())->getCurrectScolaryYear()->id)
            ->get();
    }
    public static function getSchoolType(): DepenseType
    {
        return DepenseType::where('name', 'like', '%Ecole%')->first();
    }
    public static function create(array $inputs): DepenseType
    {
        $inputs['school_id'] = auth()->user()->school->id;
        $inputs['scolary_year_id'] = (new SchoolHelper())->getCurrectScolaryYear()->id;
        return DepenseType::create($inputs);
    }
    public static function show(string $id): DepenseType
    {
        return DepenseType::find($id);
    }
    public static function update(DepenseType $DepenseType, array $inputs)
    {
        $inputs['school_id'] = auth()->user()->school->id;
        $inputs['scolary_year_id'] = (new SchoolHelper())->getCurrectScolaryYear()->id;
        $DepenseType->update($inputs);
    }
    public static function delete(DepenseType $DepenseType)
    {
        $DepenseType->delete();
    }
}
