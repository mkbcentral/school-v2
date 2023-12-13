<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentResponsable extends Model
{
    use HasFactory;
    protected $fillable=['name_responsable','phone','other_phone','email','school_id'];

    /**
     * Get all of the students for the StudentResponsable
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
