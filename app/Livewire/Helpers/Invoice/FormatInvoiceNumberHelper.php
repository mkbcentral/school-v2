<?php

namespace App\Livewire\Helpers\Invoice;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\ClasseOption;

class FormatInvoiceNumberHelper
{
    public function formatInscriptionInvoiceNumber($classeOptionId):string{
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        $classeOption=ClasseOption::find($classeOptionId);
        return substr(auth()->user()->school->name,0,2)
            .'-'.rand(1000,10000).'-'.
            substr($classeOption->name,0,1).'-'
            .substr($scolaryYear->name,-3).'-ISC';
    }

    public function formatPaymentInvoiceNumber($classeOptionId):string{
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        $classeOption=ClasseOption::find($classeOptionId);
        return substr(auth()->user()->school->name,0,2)
            .'-'.rand(1000,10000).'-'.
            substr($classeOption->name,0,1).'-'
            .substr($scolaryYear->name,-3).'-FR';
    }
    public function formatLatePaymentInvoiceNumber($classeOptionId):string{
        $scolaryYear=(new SchoolHelper())->getCurrentScolaryYear();
        $classeOption=ClasseOption::find($classeOptionId);
        return substr(auth()->user()->school->name,0,2)
            .'-'.rand(1000,10000).'-'.
            substr($classeOption->name,0,1).'-'
            .substr($scolaryYear->name,-3).'-ARR';
    }
}
