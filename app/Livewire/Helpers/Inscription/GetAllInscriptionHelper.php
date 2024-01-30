<?php

namespace  App\Livewire\Helpers\Inscription;

use App\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GetAllInscriptionHelper
{
    public static function getAllInscription($scolaryYearId, $classeId, string $keyTosearch): LengthAwarePaginator
    {
        if ($classeId == 0) {
            return Inscription::join('students', 'inscriptions.student_id', '=', 'students.id')
                ->join('cost_inscriptions', 'cost_inscriptions.id', '=', 'inscriptions.cost_inscription_id')
                ->join('rates', 'rates.id', '=', 'inscriptions.rate_id')
                ->where('inscriptions.scolary_year_id', $scolaryYearId)
                ->where('students.name', 'LIKE', '%' . $keyTosearch . '%')
                ->where('inscriptions.is_changed_classe', false)
                ->orderBy('inscriptions.created_at', 'DESC')
                ->with('Cost')
                ->with('student')
                ->with('school')
                ->with('classe.classeOption')
                ->select('inscriptions.*')
                ->paginate(25);
        } else {
            return Inscription::join('students', 'inscriptions.student_id', '=', 'students.id')
                ->join('cost_inscriptions', 'cost_inscriptions.id', '=', 'inscriptions.cost_inscription_id')
                ->join('rates', 'rates.id', '=', 'inscriptions.rate_id')
                ->where('inscriptions.scolary_year_id', $scolaryYearId)
                ->where('inscriptions.classe_id', $classeId)
                ->where('students.name', 'LIKE', '%' . $keyTosearch . '%')
                ->where('inscriptions.is_changed_classe', false)
                ->orderBy('inscriptions.created_at', 'DESC')
                ->with('Cost')
                ->with('student')
                ->with('school')
                ->with('classe.classeOption')
                ->select('inscriptions.*')
                ->paginate(25);
        }
    }

    public static function getListInscriptionForCurrentYear(string $keyTosearch): LengthAwarePaginator
    {
        return Inscription::join('students', 'inscriptions.student_id', '=', 'students.id')
            ->join('cost_inscriptions', 'cost_inscriptions.id', '=', 'inscriptions.cost_inscription_id')
            ->where('inscriptions.scolary_year_id', (new SchoolHelper())->getCurrentScolaryYear()->id)
            ->where('students.name', 'LIKE', '%' . $keyTosearch . '%')
            ->where('inscriptions.is_changed_classe', false)
            ->orderBy('students.name', 'ASC')
            ->with(['cost', 'student', 'school', 'classe.classeOption'])
            ->select('inscriptions.*')
            ->paginate(15);
    }

    public static function getListInscriptionByClasseForCurrentYear($classeId, string $keyTosearch): Collection
    {
        return Inscription::join('students', 'inscriptions.student_id', '=', 'students.id')
            ->join('cost_inscriptions', 'cost_inscriptions.id', '=', 'inscriptions.cost_inscription_id')
            ->where('inscriptions.scolary_year_id', (new SchoolHelper())->getCurrentScolaryYear()->id)
            ->where('students.name', 'LIKE', '%' . $keyTosearch . '%')
            ->where('inscriptions.classe_id', $classeId)
            ->where('inscriptions.is_changed_classe', false)
            ->orderBy('students.name', 'ASC')
            ->with(['cost', 'student', 'school', 'classe.classeOption'])
            ->select('inscriptions.*')
            ->get();
    }
}
