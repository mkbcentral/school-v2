<?php

namespace App\Livewire\Helpers\Inscription;

use App\Models\Inscription;
use Illuminate\Support\Facades\DB;

class GetCounterInscriptionHelper
{
    /**
     * Récuperer le nombre toltal des nouvelles inscriptions par jour
     * @param $date
     * @param $scolaryYearId
     * @return int
     */
    public function getCountNewInscriptionsByDate($date,$scolaryYearId): int
    {
        return Inscription::join('students','inscriptions.student_id','=','students.id')
            ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
            ->join('rates','rates.id','=','inscriptions.rate_id')
            ->where('inscriptions.scolary_year_id',$scolaryYearId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('inscriptions.is_paied',true)
            ->whereDate('inscriptions.created_at',$date)
            ->orderBy('inscriptions.created_at','DESC')
            ->where('inscriptions.is_old_student',false)
            ->with('Cost')
            ->with('student')
            ->with('school')
            ->with('classe')
            ->count();
    }

    /**
     * Récuprer le nombre des réinscription par jour
     * @param $date
     * @param $scolaryYearId
     * @return int
     */
    public function getCountOldStudentInscriptionsByDate($date,$scolaryYearId): int
    {
        return Inscription::join('students','inscriptions.student_id','=','students.id')
            ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
            ->join('rates','rates.id','=','inscriptions.rate_id')
            ->where('inscriptions.scolary_year_id',$scolaryYearId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('inscriptions.is_paied',true)
            ->whereDate('inscriptions.created_at',$date)
            ->orderBy('inscriptions.created_at','DESC')
            ->where('inscriptions.is_old_student',true)
            ->with('Cost')
            ->with('student')
            ->with('school')
            ->with('classe')
            ->count();
    }

    /**
     * Récuperer le nombre d'inscriprion par ssection
     * @param $sectionId
     * @param $scolaryYearId
     * @return int
     */
    public function getCountInscriptionsSection($sectionId,$scolaryYearId): int
    {
        return Inscription::join('classes','classes.id','=','inscriptions.classe_id')
            ->join('classe_options','classe_options.id','=','classes.classe_option_id')
            ->join('sections','sections.id','=','classe_options.section_id')
            ->where('inscriptions.scolary_year_id',$scolaryYearId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('inscriptions.is_paied',true)
            ->where('classe_options.section_id',$sectionId)
            ->with('Cost')
            ->with('student')
            ->with('school')
            ->with('classe')
            ->count();
    }
}
