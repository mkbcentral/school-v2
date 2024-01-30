<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepenseSource extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'month_name', 'school_id', 'scolary_year_id'];
}
