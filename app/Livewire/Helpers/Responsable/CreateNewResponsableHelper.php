<?php

namespace App\Livewire\Helpers\Responsable;

use App\Models\StudentResponsable;

class CreateNewResponsableHelper
{
    /**
     * Créer un nouveau responsable de l'élève
     * @param array $data
     * @return StudentResponsable
     */
    public static function create(array $data): StudentResponsable{
        return StudentResponsable::create($data);
    }
}
