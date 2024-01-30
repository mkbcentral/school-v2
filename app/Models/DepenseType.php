<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepenseType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'scolary_year_id', 'school_id'];
}
