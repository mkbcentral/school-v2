<?php

namespace App\Livewire\Helpers\Inscription;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use Illuminate\Support\Collection;

class GetListInscriptionByClasseHelper
{
    public static function  getListInscrptinForCurrentYear(int $classeId, $scolaryId): Collection
    {
        return Inscription::join('students', 'inscriptions.student_id', '=', 'students.id')
            ->join('cost_inscriptions', 'cost_inscriptions.id', '=', 'inscriptions.cost_inscription_id')
            ->where('inscriptions.scolary_year_id', $scolaryId)
            ->where('inscriptions.classe_id', $classeId)
            ->where('inscriptions.is_changed_classe', false)
            ->orderBy('students.name', 'ASC')
            ->with(['cost', 'student', 'school', 'classe.classeOption'])
            ->select('inscriptions.*')
            ->get();
    }
}
