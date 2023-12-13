<?php

namespace App\Livewire\Helpers\Depense;

use App\Models\DepenseSource;
use Illuminate\Support\Collection;

class DepenseSourceHelper
{
    public static function get():Collection{
        return DepenseSource::all();
    }
    public static function create(array $inputs):DepenseSource
    {
        $inputs['school_id']=auth()->user()->school->id;
        return DepenseSource::create($inputs);
    }
    public static function show(string $id):DepenseSource
    {
        return DepenseSource::find($id);
    }
    public static function update(DepenseSource $depenseSource, array $inputs)
    {
        $depenseSource->update($inputs);
    }
    public static function delete(DepenseSource $depenseSource)
    {
        $depenseSource->delete();
    }
}
