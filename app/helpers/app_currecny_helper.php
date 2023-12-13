<?php

use App\Models\TypeOtherCost;

function app_get_currency_type_cost_name($key){
    $typeCost=TypeOtherCost::where('name',$key)->first();
    return $typeCost?->currency==null?'':$typeCost?->currency->currency;
}
