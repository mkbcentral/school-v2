<?php

namespace App\Livewire\Helpers\Cost;

use App\Models\CostGeneral;
use Illuminate\Support\Collection;

class CrudCostGeneralHelper
{
    public static function create(array $inputs)
    {
        CostGeneral::create($inputs);
    }
    public static function show(string $id): CostGeneral
    {
        return CostGeneral::find($id);
    }
    public static function update(CostGeneral $costGeneral, array $inputs)
    {
        $costGeneral->update($inputs);
    }
    public static function delete(CostGeneral $costGeneral)
    {
        $costGeneral->delete();
    }
}
