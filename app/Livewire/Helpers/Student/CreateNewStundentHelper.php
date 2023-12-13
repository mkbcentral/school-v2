<?php

namespace App\Livewire\Helpers\Student;

use App\Models\Student;

class CreateNewStundentHelper
{
    /**
     * Créer un nouvel éleve
     * @param array $data
     * @return Student
     */
    public  static function create(array $data):Student{
       return Student::create($data);
    }
}
