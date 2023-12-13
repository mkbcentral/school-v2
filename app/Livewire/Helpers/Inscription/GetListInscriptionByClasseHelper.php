<?php

namespace App\Livewire\Helpers\Inscription;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use Illuminate\Support\Collection;

class GetListInscriptionByClasseHelper
{
    public static function  getListInscrptinForCurrentYear(int $classeId,$scolaryId):Collection{
        return Inscription::join('classes','classes.id','=','inscriptions.classe_id')
            ->join('students','students.id','inscriptions.student_id')
            ->where('inscriptions.scolary_year_id',$scolaryId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('inscriptions.is_paied',true)
            ->where('inscriptions.is_old_student',false)
            ->where('inscriptions.classe_id',$classeId)
            ->orderBy('students.name','ASC')
            ->with(['student'])
            ->get();
    }
}
