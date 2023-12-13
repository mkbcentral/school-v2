<?php

namespace App\Livewire\Helpers\Inscription;

use App\Models\Inscription;

class ExistingInscriptionCheckerHelper
{
    /**
     * Vélifier si l'élève a déjà une inscription
     * @param $studentId
     * @param $classeId
     * @param $scolaryYearId
     * @return Inscription|null
     */
    public static function checkIfInscriptionExist($studentId,$classeId,$scolaryYearId): ?Inscription
    {
          return Inscription::where('student_id', $studentId)
            ->where('classe_id', $classeId)
            ->where('scolary_year_id', $scolaryYearId)
            ->first();
    }
}
