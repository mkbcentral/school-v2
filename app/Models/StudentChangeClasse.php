<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentChangeClasse extends Model
{
    use HasFactory;
    protected $fillable = ['changed_inscription_id', 'new_inscription_id', 'school_id', 'scolary_year_id'];
}
