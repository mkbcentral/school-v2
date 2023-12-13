<?php

namespace App\Livewire\Helpers\Inscription;

use App\Livewire\Helpers\Invoice\FormatInvoiceNumberHelper;
use App\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;

class CreateNewInscriptionHelper
{
    /**
     * Créer un nouvelle inscription
     * @param $scolaryYear_id
     * @param $cost_inscription_id
     * @param $student_id
     * @param $classe_id
     * @param $classe_option_id
     * @param $is_old_student
     * @return Inscription
     */
    public  function create($scolaryYear_id,$cost_inscription_id,$student_id,$classe_id,$classe_option_id,$is_old_student=false):Inscription{
        $rate=(new SchoolHelper())->getCurrentRate();
        $inscription= Inscription::create([
            'number_paiment'=>(new FormatInvoiceNumberHelper())->formatInscriptionInvoiceNumber($classe_option_id),
            'scolary_year_id' => $scolaryYear_id,
            'cost_inscription_id' => $cost_inscription_id,
            'student_id' => $student_id,
            'classe_id' => $classe_id,
            'school_id' => auth()->user()->school->id,
            'user_id' => auth()->user()->id,
            'rate_id' => $rate->id,
            'is_old_student'=>$is_old_student
        ]);
        return $inscription;
    }
}
