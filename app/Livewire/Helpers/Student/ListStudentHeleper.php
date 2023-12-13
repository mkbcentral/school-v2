<?php

namespace App\Livewire\Helpers\Student;

use App\Models\Student;
use Illuminate\Support\Collection;

class ListStudentHeleper
{

    public  static function getListStudentForLastYear(string $keyToSearch = '', int $pear_page = 10)
    {
        return Student::join('scolary_years', 'scolary_years.id', '=', 'students.scolary_year_id')
            ->where('scolary_years.active', false)
            ->where('students.school_id', auth()->user()->school->id)
            ->where('students.name', 'Like', '%' . $keyToSearch . '%')
            ->select('students.*')
            ->orderBy('students.name', 'ASC')
            ->paginate($pear_page);
    }
}
